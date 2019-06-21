jQuery(document).ready(function($) {
    var engine = new Bloodhound({
        remote: {
            url: '/tourist/find?q=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: engine
    });

    $(".search-input").typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        source: engine.ttAdapter(),
        name: 'tour-name',
        display: function(data) {
            return data.name;
        },
        templates: {
            empty: [
                '<div class="header-title">{{ __('
                Name ') }}</div><div class="list-group search-results-dropdown"><div class="list-group-item">{{ __('
                Nothing found ') }}</div></div>'
            ],
            header: [
                '<div class="header-title">{{ __('
                Name ') }}</div><div class="list-group search-results-dropdown"></div>'
            ],
            suggestion: function(data) {

                return '<a href="/tourist/chi-tiet-tour/' + data.slug + '.html" class="list-group-item">' + data.name + '</a>';
            }

        }
    });
});