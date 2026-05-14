(function ($) {
  var BusinessHours = function ($scope) {
    const $wrapper = $scope.find(".pea-timezone-main-wrapper");
    if (!$wrapper.length) return;

    const $timeEl = $scope.find(".pea_business_hours-current-time");
    const $remainingTime = $scope.find(".pea-timezone-remaining-time");
    const $timezoneOffset = $scope.find(".pea_business_hours-timezone-offset");

    const statusWrapper = $scope.find(".pea-timezone-status-wrapper");
    const $statusText = $scope.find(".pea-timezone-status");
    const $noticeText = $scope.find(".pea-timezone-status-off-notice");
    const $timeText = $scope.find(".pea-timezone-end-time");
    const $locationEl = $scope.find(".pea_business_hours-location-name");

    // DATA
    const selectedFormat = $wrapper.data("time-format");
    const isUtc = $wrapper.attr("data-utc-timezone-switcher") === "true";
    const startTime = $wrapper.data("start-time");
    const endTime = $wrapper.data("end-time");
    const endTimeFormat = $wrapper.data("end-format");
    const lebel = $wrapper.data("remaining-lebel");

    const statusOnText = $wrapper.data("status-on");
    const statusOffText = $wrapper.data("status-off");
    const onNoticeText = $wrapper.data("on-notice");
    const offNoticeText = $wrapper.data("off-notice");

    const weekendInfp = $wrapper.data("weekend-info") || [];
    const holidayInfo = $wrapper.data("holiday-info") || [];
    const weekendText = $wrapper.data("weekend-text") || "Weekend";
    const holidayText = $wrapper.data("holiday-text") || "Holiday";

    const monthlySchedule = $wrapper.data("monthly-schedule");
    const selectedTimezone = $wrapper.data("selected-timezone");

    function getCurrentTime() {
      if (selectedTimezone) {
        return new Date(new Date().toLocaleString("en-US", { timeZone: selectedTimezone }));
      }
      return new Date();
    }

    function formatTimeString(timeStr) {
      if (!timeStr || typeof timeStr !== "string" || !timeStr.includes(":")) return timeStr;

      let [h, m] = timeStr.split(":").map(Number);
      const ampm = h >= 12 ? "PM" : "AM";
      const h12 = h % 12 || 12;
      const mm = String(m).padStart(2, "0");

      switch (selectedFormat) {
        case "hh:mm":
        case "hh:mm:ss":
          return `${h12}:${mm} ${ampm}`;
        case "HH:mm":
        case "HH:mm:ss":
          return `${h}:${mm}`;
        default:
          return `${h12}:${mm} ${ampm}`;
      }
    }

    /*------LOCATION FROM TIMEZONE------ */
    function getLocation() {
      const timezone =
        selectedTimezone || Intl.DateTimeFormat().resolvedOptions().timeZone;
      if (timezone) {
        const locationName = timezone.replace(/\//g, "-");
        $locationEl.text(locationName);
      } else {
        $locationEl.text("Local Timezone");
      }
    }

    getLocation();

    /* --------- LIVE CLOCK ----------- */
    function updateTime() {
      const now = getCurrentTime();
      let hours = now.getHours();
      let minutes = String(now.getMinutes()).padStart(2, "0");
      let seconds = String(now.getSeconds()).padStart(2, "0");

      const ampm = hours >= 12 ? "PM" : "AM";
      const hour12 = hours % 12 || 12;

      let formattedTime = "";

      switch (selectedFormat) {
        case "hh:mm":
          formattedTime = `${hour12}:${minutes} ${ampm}`;
          break;
        case "hh:mm:ss":
          formattedTime = `${hour12}:${minutes}:${seconds} ${ampm}`;
          break;
        case "HH:mm":
          formattedTime = `${hours}:${minutes}`;
          break;
        case "HH:mm:ss":
          formattedTime = `${hours}:${minutes}:${seconds}`;
          break;
        default:
          formattedTime = `${hour12}:${minutes} ${ampm}`;
      }

      $timeEl.text(formattedTime);
    }

    updateTime();
    setInterval(updateTime, 1000);

    /* --------- TIMEZONE OFFSET-------- */

    function showTimezone() {
      let sign = "+";
      let hours = "00";
      let minutes = "00";
      let absolute = 0;

      if (selectedTimezone) {
        try {
          const parts = new Intl.DateTimeFormat("en-US", {
            timeZone: selectedTimezone,
            timeZoneName: "longOffset",
          }).formatToParts(new Date());

          const offsetPart = parts.find((p) => p.type === "timeZoneName").value;

          if (offsetPart.includes("+") || offsetPart.includes("-")) {
            sign = offsetPart.includes("+") ? "+" : "-";
            const timePart = offsetPart.split(sign)[1];
            [hours, minutes] = timePart.split(":");
            absolute = parseInt(hours) + parseInt(minutes) / 60;
          }
        } catch (e) {
          console.error("Error calculating timezone offset:", e);
        }
      } else {
        const offsetMinutes = new Date().getTimezoneOffset();
        const offsetHours = -offsetMinutes / 60;
        sign = offsetHours >= 0 ? "+" : "-";
        absolute = Math.abs(offsetHours);
        hours = String(Math.floor(absolute)).padStart(2, "0");
        minutes = String(Math.round((absolute % 1) * 60)).padStart(2, "0");
      }

      const formattedOffset = isUtc
        ? `(UTC${sign}${hours}:${minutes})`
        : `(GMT${sign}${absolute})`;

      $timezoneOffset.text(formattedOffset);
    }

    showTimezone();

    /* ---------------STATUS + REMAINING TIME ----------- */

    function showRemainingTime() {
      const now = getCurrentTime();
      const todayDay = now
        .toLocaleString("en-US", { weekday: "long" })
        .toLowerCase();

      // Holiday Check
      function isHoliday(date) {
        if (!holidayInfo || !holidayInfo.length) return false;
        const dateStr = date.toISOString().split("T")[0]; // YYYY-MM-DD
        return holidayInfo.some((h) => {
          if (!h.pea_holiday_date) return false;
          return h.pea_holiday_date.startsWith(dateStr);
        });
      }

      const isTodayHoliday = isHoliday(now);
      const isWeekend = Array.isArray(weekendInfp) && weekendInfp.includes(todayDay);

      function handleClosedState(statusText) {
        let nextWorkingDayDate = new Date(now);
        const daysOfWeek = [
          "sunday",
          "monday",
          "tuesday",
          "wednesday",
          "thursday",
          "friday",
          "saturday",
        ];

        do {
          nextWorkingDayDate.setDate(nextWorkingDayDate.getDate() + 1);
          const nextDayName = daysOfWeek[nextWorkingDayDate.getDay()];
          const isNextDayWeekend = weekendInfp.includes(nextDayName);
          const isNextDayHoliday = isHoliday(nextWorkingDayDate);

          if (!isNextDayWeekend && !isNextDayHoliday) {
            break;
          }
        } while (true);

        const nextWorkingDay = nextWorkingDayDate.toLocaleString("en-US", {
          weekday: "long",
          month: "long",
          day: "numeric",
        });
        const nextStartTime = formatTimeString(startTime);

        $statusText.html(statusText);
        $noticeText.html(`${statusText}. ${onNoticeText}`);
        $timeText.text(`${nextStartTime} ${nextWorkingDay}`);

        $remainingTime.text("");
        $remainingTime.closest(".pea-timezone-remaining-wrapper").hide();

        statusWrapper
          .removeClass("pea-timezone-status-wrapper")
          .addClass("pea-timezone-status-wrapper-closed");

        statusWrapper
          .find(".pea-timezone-status-info-box")
          .removeClass("open")
          .addClass("closed");
      }

      if (isTodayHoliday) {
        handleClosedState(holidayText);
        return;
      }

      if (isWeekend) {
        handleClosedState(weekendText);
        return;
      }

      const currentMonth = now.toLocaleString("en-US", { month: "long" }).toLowerCase();

      let effectiveStartTime = startTime;
      let effectiveEndTime = endTime;

      if (monthlySchedule && Array.isArray(monthlySchedule)) {
        const monthEntry = monthlySchedule.find(
          (entry) => entry.pea_schedule_month === currentMonth,
        );
        if (monthEntry) {
          effectiveStartTime = monthEntry.pea_schedule_start_time || startTime;
          effectiveEndTime = monthEntry.pea_schedule_end_time || endTime;
        }
      }

      let [startHour, startMinute] = effectiveStartTime.split(":").map(Number);
      let [endHour, endMinute] = effectiveEndTime.split(":").map(Number);

      const todayStart = new Date(now);
      todayStart.setHours(startHour, startMinute, 0, 0);

      const todayEnd = new Date(now);
      todayEnd.setHours(endHour, endMinute, 0, 0);

      let target;
      let isOpen = false;

      if (now < todayStart) {
        target = todayStart;
        isOpen = false;
      } else if (now >= todayStart && now < todayEnd) {
        target = todayEnd;
        isOpen = true;
      } else {
        target = new Date(todayStart);
        target.setDate(target.getDate() + 1);
        isOpen = false;
      }

      /* -------- STATUS TEXT CHANGE -------- */

      if (isOpen) {
        $statusText.text(statusOnText);
        $noticeText.text(offNoticeText);
        $timeText.text(formatTimeString(effectiveEndTime));

        statusWrapper
          .removeClass("pea-timezone-status-wrapper-closed")
          .addClass("pea-timezone-status-wrapper");

        statusWrapper
          .find(".pea-timezone-status-info-box")
          .removeClass("closed")
          .addClass("open");
      } else {
        $statusText.text(statusOffText);
        $noticeText.text(onNoticeText);
        $timeText.text(formatTimeString(effectiveStartTime));

        statusWrapper
          .removeClass("pea-timezone-status-wrapper")
          .addClass("pea-timezone-status-wrapper-closed");

        statusWrapper
          .find(".pea-timezone-status-info-box")
          .removeClass("open")
          .addClass("closed");
      }

      /* -------- REMAINING TIME -------- */

      const diff = target - now;

      const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
      const minutes = Math.floor((diff / (1000 * 60)) % 60);
      const seconds = Math.floor((diff / 1000) % 60);

      let formattedTime = "";

      switch (endTimeFormat) {
        case "hour-minutes":
          formattedTime = `${hours} hours ${minutes} minutes`;
          break;
        case "h-m":
          formattedTime = `${hours}h ${minutes}m`;
          break;
        case "hour":
          formattedTime = `${hours} hours`;
          break;
        case "minutes":
          const totalMinutes = Math.floor(diff / (1000 * 60));
          formattedTime = `${totalMinutes} minutes `;
          break;
        default:
          formattedTime = `${hours}:${minutes}`;
      }

      $remainingTime.text(`${lebel} ${formattedTime}`);
    }

    showRemainingTime();
    setInterval(showRemainingTime, 1000);
  };

  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/pea_business_hours.default",
      BusinessHours,
    );
  });
})(jQuery);
