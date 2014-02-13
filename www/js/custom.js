$(document).ready(function() {
    /* grab important elements */
    var sortInput = $('#sort_order');
    var messageBox = $('#infotxt');
    var list = $('#sortable-list');
    /* create requesting function to avoid duplicate code */

    var request = function() {
        $.ajax({
            beforeSend: function() {
                $('#infotxt').show();
                $('#savesort').hide();
                messageBox.text('Sortering wordt opgeslagen.');
            },
            complete: function() {
                messageBox.text('Sortering is opgeslagen');
            },
            data: 'sort_order=' + sortInput[0].value + '&category_id=' + $('#category_id').val(),
            type: 'get',
            url: '/afbeeldingen/store_sort'
        });
    };
    /* worker function */
    var fnSubmit = function(save) {
        var sortOrder = [];
        list.children('li').each(function() {
            sortOrder.push($(this).data('id'));
        });
        sortInput.val(sortOrder.join(','));
        if (save) {
            request();
        }
    };
    /* store values */
    list.children('li').each(function() {
        var li = $(this);
        li.data('id', li.attr('title')).attr('title', '');
    });
    /* sortables */
    list.sortable({
        opacity: 0.7,
        update: function() {
            $('#infotxt').hide();
            $('#savesort').show();

        }
    });
    list.disableSelection();
    /* ajax form submission */
    $('#dd-form').bind('submit', function(e) {
        if (e)
            e.preventDefault();
        fnSubmit(true);
    });
});


    function switchView(view, speed) {
        var fader = 250;
        if (speed == 'fast') {
            fader = 0;
        }
        if (view == 'listview') {
            $('.imagelist.gridview').fadeOut(fader, function() {
                $('.imagelist.listview').fadeIn(fader);
            });
            $('#gridbutton').removeClass('active');
            $('#listbutton').addClass('active');
            $('#message-box').hide();
        }
        if (view == 'gridview') {
            $('.imagelist.listview').fadeOut(fader, function() {
                $('.imagelist.gridview').fadeIn(fader);
            });
            $('#gridbutton').addClass('active');
            $('#listbutton').removeClass('active');
            $('#message-box').show();
        }
        $.cookie("switchview", view);
    }
    function editImage(id) {
        if ( $(window).scrollTop() > 350 ){
            $('html, body').animate({scrollTop: $(".topnav").offset().top+180 }, 700);
        }
        var framesrc = '/afbeeldingen/edit_image/' + id;
        $('#ei_frame').attr("src", framesrc);
        
    }
        
    function parentCloser(){
        $( ".form-btn" ).trigger( "click" );
    }

    function deleteImage(id) {
        // roep de delete functie aan, geef een id door aan het formulier in het modal
        $('#del_image').val(id);
        $('#remove_image').foundation('reveal', 'open');
    }