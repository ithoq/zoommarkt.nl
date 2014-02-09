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