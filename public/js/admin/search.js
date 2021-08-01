$(function() {
    // Set search values
    var search = JSON.parse($('#search').val());
    for (const [key, value] of Object.entries(search)) {
        if (value) {
            if (['category', 'search_type'].includes(key)) {
                $('#' + key).selectpicker('val', value);
            } else {
                $('#' + key).val(value);
            }
        }
    }
    if (search.sort_field) {
        $('.sort[data-field="' + search.sort_field + '"]').addClass(search.sort_type);
    }

    $('.sort').click(function() {
        var field = $(this).data('field');

        search.sort_field = field;
        if ($(this).hasClass('desc')) {
            search.sort_type = 'asc';
        } else {
            search.sort_type = 'desc';
        }

        goSearch(search);

        return false;
    });

    $('.btnSearch').click(function() {
        if ($('#search_type').val() === '') {
            alert('검색항목을 선택해주세요.');
            return false;
        }
        if ($('#search_keyword').val() === '') {
            alert('검색어를 입력해주세요.');
            return false;
        }

        search.search_type = $('#search_type').val();
        search.search_keyword = $('#search_keyword').val();

        goSearch(search);

        return false;
    });

    function goSearch(searchParams) {
        var params = [], url = '';
        for (const [key, value] of Object.entries(searchParams)) {
            params.push(key + '=' + value);
        }
        url = params.join('&');
        location.href = '?' + url;
    }
});
