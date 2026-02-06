( function( $ ) {
    jQuery( window ).on( 'elementor/frontend/init', function () {
        var ImageGallery = function( $scope, $ ){
            if ( 'undefined' == typeof $scope ){ return; }
            const wrapper = $scope[0]; // Convert jQuery object to DOM element
            
            function initImageGallery() {
                const galleryWrappers = wrapper.querySelectorAll('.pea-image-gallery-items');
                galleryWrappers.forEach(function(galleryWrapper) {
                    var blockID = galleryWrapper.getAttribute('data-id');
                    var lightboxLinks = galleryWrapper.querySelectorAll(`.pea-image-gallery-item`);
                    var galleryImages = Array.from(lightboxLinks);
                    var currentIndex = 0;
                    
                    function openLightbox(index) {
                        currentIndex = index;
                        var lightbox = document.createElement('div');
                        lightbox.classList.add('lightbox', blockID);
                        lightbox.innerHTML = `
                            <div class="lightbox-content">
                                <button class="lightbox-close">&times;</button>
                                <div class="lightbox-counter">${currentIndex + 1} / ${galleryImages.length}</div>
                                <button class="lightbox-prev">&#10094;</button>
                                <button class="lightbox-next">&#10095;</button>
                                <div class="lightbox-image-container">
                                    <img src="${galleryImages[currentIndex].getAttribute('href')}" alt="">
                                </div>
                                <div class="lightbox-thumbnails">
                                    ${galleryImages.map(function(img, idx) {
                                        return `
                                            <img src="${img.getAttribute('href')}" 
                                                class="thumbnail ${idx === currentIndex ? 'active' : ''}" 
                                                data-index="${idx}" />
                                        `;
                                    }).join('')}
                                </div>
                            </div>
                        `;
                        document.body.appendChild(lightbox);
                        
                        lightbox.querySelector('.lightbox-close').addEventListener('click', closeLightbox);
                        lightbox.querySelector('.lightbox-prev').addEventListener('click', prevImage);
                        lightbox.querySelector('.lightbox-next').addEventListener('click', nextImage);
                        lightbox.querySelectorAll('.thumbnail').forEach(function(thumbnail) {
                            thumbnail.addEventListener('click', function(e) {
                                currentIndex = parseInt(e.target.getAttribute('data-index'));
                                updateLightboxImage();
                            });
                        });
                        
                        document.addEventListener('keydown', handleKeyNavigation);
                        
                        function closeLightbox() {
                            lightbox.remove();
                            document.removeEventListener('keydown', handleKeyNavigation);
                        }
                        
                        function nextImage() {
                            currentIndex = (currentIndex + 1) % galleryImages.length;
                            updateLightboxImage();
                        }
                        
                        function prevImage() {
                            currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
                            updateLightboxImage();
                        }
                        
                        function updateLightboxImage() {
                            var newImage = galleryImages[currentIndex].getAttribute('href');
                            lightbox.querySelector('.lightbox-image-container img').src = newImage;
                            lightbox.querySelector('.lightbox-counter').textContent = `${currentIndex + 1} / ${galleryImages.length}`;
                            lightbox.querySelectorAll('.thumbnail').forEach(function(thumb, idx) {
                                thumb.classList.toggle('active', idx === currentIndex);
                            });
                        }
                        
                        function handleKeyNavigation(event) {
                            if (event.key === 'ArrowRight') {
                                nextImage();
                            } else if (event.key === 'ArrowLeft') {
                                prevImage();
                            } else if (event.key === 'Escape') {
                                closeLightbox();
                            }
                        }
                    }
                    
                    galleryImages.forEach(function(link, index) {
                        link.addEventListener('click', function(event) {
                            event.preventDefault();
                            event.stopPropagation();
                            event.stopImmediatePropagation();
                            openLightbox(index);
                        });
                    });
                });
            }
            
            initImageGallery();
        }
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pea_image_gallery.default', ImageGallery );
    });
} )( jQuery );