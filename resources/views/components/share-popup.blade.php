<!-- Popup Share -->
<div class="masterstudy-share-popup" id="sharePopup">
    <div class="masterstudy-share-popup__content">
        <div class="masterstudy-share-popup__header">
            <h4>Share</h4>
            <button class="masterstudy-share-popup__close" id="closeSharePopup">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="masterstudy-share-popup__body">
            <div class="masterstudy-share-popup__social">
                <a href="#" class="masterstudy-share-popup__social-item masterstudy-share-popup__social-facebook"
                    data-platform="facebook">
                    <i class="fa fa-facebook"></i>
                    <span>Facebook</span>
                </a>
                <a href="#" class="masterstudy-share-popup__social-item masterstudy-share-popup__social-twitter"
                    data-platform="twitter">
                    <i class="fa fa-twitter"></i>
                    <span>Twitter</span>
                </a>
                <a href="#" class="masterstudy-share-popup__social-item masterstudy-share-popup__social-linkedin"
                    data-platform="linkedin">
                    <i class="fa fa-linkedin"></i>
                    <span>LinkedIn</span>
                </a>
                <a href="#" class="masterstudy-share-popup__social-item masterstudy-share-popup__social-telegram"
                    data-platform="telegram">
                    <i class="fa fa-telegram"></i>
                    <span>Telegram</span>
                </a>
                <a href="#" class="masterstudy-share-popup__social-item masterstudy-share-popup__social-whatsapp"
                    data-platform="whatsapp">
                    <i class="fa fa-whatsapp"></i>
                    <span>WhatsApp</span>
                </a>
            </div>
            <div class="masterstudy-share-popup__link">
                <p>Copy link</p>
                <div class="masterstudy-share-popup__link-input">
                    <input type="text" id="shareUrl" value="{{ url()->current() }}" readonly>
                    <button id="copyShareUrl">
                        <i class="fa fa-copy"></i>
                        <span>Copy</span>
                    </button>
                </div>
                <div class="masterstudy-share-popup__link-copied" id="copiedMessage">
                    <i class="fa fa-check"></i> Link copied to clipboard
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Overlay -->
<div class="masterstudy-share-popup-overlay" id="sharePopupOverlay"></div>

@once
    @push('styles')
        <style>
            /* CSS giống như đã cung cấp ở trên */
            .masterstudy-single-course-share-button {
                display: inline-flex;
                align-items: center;
                cursor: pointer;
                padding: 6px 12px;
                border-radius: 4px;
                transition: all 0.3s ease;
            }

            .masterstudy-single-course-share-button:hover {
                background-color: #f5f5f5;
            }

            .masterstudy-single-course-share-button__title {
                margin-left: 6px;
                font-weight: 500;
            }

            /* Popup Styles */
            .masterstudy-share-popup {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) scale(0.8);
                width: 400px;
                max-width: 90%;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 5px 30px rgba(0, 0, 0, 0.15);
                z-index: 1001;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .masterstudy-share-popup.active {
                opacity: 1;
                visibility: visible;
                transform: translate(-50%, -50%) scale(1);
            }

            .masterstudy-share-popup__content {
                padding: 20px;
            }

            .masterstudy-share-popup__header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                padding-bottom: 15px;
                border-bottom: 1px solid #eee;
            }

            .masterstudy-share-popup__header h4 {
                margin: 0;
                font-size: 18px;
                font-weight: 600;
            }

            .masterstudy-share-popup__close {
                background: none;
                border: none;
                cursor: pointer;
                font-size: 18px;
                color: #666;
                transition: color 0.2s ease;
            }

            .masterstudy-share-popup__close:hover {
                color: #333;
            }

            .masterstudy-share-popup__social {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 12px;
                margin-bottom: 20px;
            }

            .masterstudy-share-popup__social-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 12px 8px;
                border-radius: 6px;
                color: #fff;
                text-decoration: none;
                transition: all 0.2s ease;
            }

            .masterstudy-share-popup__social-item i {
                font-size: 24px;
                margin-bottom: 5px;
            }

            .masterstudy-share-popup__social-facebook {
                background-color: #3b5998;
            }

            .masterstudy-share-popup__social-twitter {
                background-color: #1da1f2;
            }

            .masterstudy-share-popup__social-linkedin {
                background-color: #0077b5;
            }

            .masterstudy-share-popup__social-telegram {
                background-color: #0088cc;
            }

            .masterstudy-share-popup__social-whatsapp {
                background-color: #25d366;
            }

            .masterstudy-share-popup__social-item:hover {
                opacity: 0.9;
                transform: translateY(-2px);
            }

            .masterstudy-share-popup__link {
                margin-top: 20px;
            }

            .masterstudy-share-popup__link p {
                margin-bottom: 8px;
                font-weight: 500;
                color: #555;
            }

            .masterstudy-share-popup__link-input {
                display: flex;
                border: 1px solid #ddd;
                border-radius: 4px;
                overflow: hidden;
            }

            .masterstudy-share-popup__link-input input {
                flex: 1;
                padding: 10px 12px;
                border: none;
                outline: none;
                font-size: 14px;
                color: #333;
                background-color: #f9f9f9;
            }

            .masterstudy-share-popup__link-input button {
                display: flex;
                align-items: center;
                padding: 10px 15px;
                background-color: #f1f1f1;
                border: none;
                cursor: pointer;
                transition: background-color 0.2s ease;
            }

            .masterstudy-share-popup__link-input button:hover {
                background-color: #e5e5e5;
            }

            .masterstudy-share-popup__link-input button i {
                margin-right: 6px;
            }

            .masterstudy-share-popup__link-copied {
                margin-top: 8px;
                padding: 6px 10px;
                background-color: #e3f9eb;
                color: #28a745;
                border-radius: 4px;
                font-size: 13px;
                display: none;
            }

            .masterstudy-share-popup__link-copied.show {
                display: block;
            }

            .masterstudy-share-popup-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .masterstudy-share-popup-overlay.active {
                opacity: 1;
                visibility: visible;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Các phần tử DOM
                const shareButton = document.getElementById('shareButton');
                const sharePopup = document.getElementById('sharePopup');
                const sharePopupOverlay = document.getElementById('sharePopupOverlay');
                const closeSharePopup = document.getElementById('closeSharePopup');
                const shareUrl = document.getElementById('shareUrl');
                const copyShareUrl = document.getElementById('copyShareUrl');
                const copiedMessage = document.getElementById('copiedMessage');
                const socialLinks = document.querySelectorAll('.masterstudy-share-popup__social-item');

                // Hiển thị popup chia sẻ
                shareButton.addEventListener('click', function() {
                    // Lấy URL hiện tại
                    const currentUrl = window.location.href;
                    shareUrl.value = currentUrl;

                    // Hiển thị popup
                    sharePopup.classList.add('active');
                    sharePopupOverlay.classList.add('active');
                });

                // Đóng popup khi nhấp vào nút đóng
                closeSharePopup.addEventListener('click', function() {
                    sharePopup.classList.remove('active');
                    sharePopupOverlay.classList.remove('active');
                });

                // Đóng popup khi nhấp vào overlay
                sharePopupOverlay.addEventListener('click', function() {
                    sharePopup.classList.remove('active');
                    sharePopupOverlay.classList.remove('active');
                });

                // Copy URL vào clipboard
                copyShareUrl.addEventListener('click', function() {
                    shareUrl.select();
                    document.execCommand('copy');

                    // Hiển thị thông báo đã copy
                    copiedMessage.classList.add('show');

                    // Ẩn thông báo sau 3 giây
                    setTimeout(function() {
                        copiedMessage.classList.remove('show');
                    }, 3000);
                });

                // Xử lý chia sẻ lên mạng xã hội
                socialLinks.forEach(function(link) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();

                        const platform = this.getAttribute('data-platform');
                        const url = encodeURIComponent(window.location.href);
                        const title = encodeURIComponent(document.title);

                        let shareUrl;

                        switch (platform) {
                            case 'facebook':
                                shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
                                break;
                            case 'twitter':
                                shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
                                break;
                            case 'linkedin':
                                shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
                                break;
                            case 'telegram':
                                shareUrl = `https://t.me/share/url?url=${url}&text=${title}`;
                                break;
                            case 'whatsapp':
                                shareUrl = `https://wa.me/?text=${title} ${url}`;
                                break;
                        }

                        if (shareUrl) {
                            window.open(shareUrl, '_blank', 'width=600,height=400');
                        }
                    });
                });
            });
        </script>
    @endpush
@endonce
