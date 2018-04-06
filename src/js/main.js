(function($) {
    var w = 0;

    $(window).on('load', function(){
        w = $(window).width();
    });

    $(document).ready(function() {


        $('.modal.video-modal').each(function () {
            $videoModal = $(this);

            $videoModal.appendTo("body");

            var url = $videoModal.find(".video-container iframe").attr('src');

            $videoModal.on('hide.bs.modal', function(){
                $videoModal.find(".video-container iframe").attr('src', '');
            });

            $videoModal.on('show.bs.modal', function(){
                $videoModal.find(".video-container iframe").attr('src', url);
            });
        });

        // if ($(window).width() > 767) {
        //     big_screen_fullpage();
        // }

        // $(document).on('click', '.page-template-landingpage .up-link-container span', function() {
        //     $.fn.fullpage.moveTo(1, 0);
        // });

        var selectedLanguage = $('.mobile-header-select-language .language-chooser li.active a').text();
        var selectedLanguageBtn = $('.mobile-header-selected-language-btn span.open-lng');
        selectedLanguageBtn.text(selectedLanguage);

        $('.mobile-header-selected-language-btn').click(function() {
            var $this = $( this );
            var mobileSelectLanguage = $('.mobile-header-select-language');

            $this.toggleClass('opened');
            mobileSelectLanguage.toggleClass('opened');

            if ($this.hasClass('opened')) {
                $('html, body').css({
                    overflow: 'hidden',
                    height: '100%'
                });
            } else {
                $('html, body').css({
                    overflow: 'auto',
                    height: 'auto'
                });
            }
        });

        $('.mobile-header-nav-menu-icon').click(function() {
            var $this = $( this );
            var mobileMenu = $('.mobile-header-nav-menu');

            $this.toggleClass('opened');
            mobileMenu.toggleClass('opened');

            if ($this.hasClass('opened')) {
                $('html, body').css({
                    overflow: 'hidden',
                    height: '100%'
                });
            } else {
                $('html, body').css({
                    overflow: 'auto',
                    height: 'auto'
                });
            }
        });
    });

    $(window).on('resize', function(){

    });
})(jQuery);