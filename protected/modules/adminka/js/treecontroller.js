function get_tree_item(url, outobj_id)
{
    $.post(url, function(data) {
        $('#'+outobj_id).html(data);
        //alert('Загрузка завершена.');
    });


}