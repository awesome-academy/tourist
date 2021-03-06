// rating review
var __slice = [].slice;

(function($, window) {
    var Starrr;

    Starrr = (function() {
        Starrr.prototype.defaults = {
            rating: void 0,
            numStars: 5,
            change: function(e, value) {}
        };

        function Starrr($el, options) {
            var i, _, _ref,
                _this = this;

            this.options = $.extend({}, this.defaults, options);
            this.$el = $el;
            _ref = this.defaults;
            for (i in _ref) {
                _ = _ref[i];
                if (this.$el.data(i) != null) {
                    this.options[i] = this.$el.data(i);
                }
            }
            this.createStars();
            this.syncRating();
            this.$el.on('mouseover.starrr', 'span', function(e) {
                return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
            });
            this.$el.on('mouseout.starrr', function() {
                return _this.syncRating();
            });
            this.$el.on('click.starrr', 'span', function(e) {
                return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
            });
            this.$el.on('starrr:change', this.options.change);
        }

        Starrr.prototype.createStars = function() {
            var _i, _ref, _results;

            _results = [];
            for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                _results.push(this.$el.append("<span class='fa .fa-star-o'></span>"));
            }

            return _results;
        };

        Starrr.prototype.setRating = function(rating) {
            if (this.options.rating === rating) {
                rating = void 0;
            }
            this.options.rating = rating;
            this.syncRating();

            return this.$el.trigger('starrr:change', rating);
        };

        Starrr.prototype.syncRating = function(rating) {
            var i, _i, _j, _ref;

            rating || (rating = this.options.rating);
            if (rating) {
                for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                    this.$el.find('span').eq(i).removeClass('fa-star-o').addClass('fa-star');
                }
            }
            if (rating && rating < 5) {
                for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                    this.$el.find('span').eq(i).removeClass('fa-star').addClass('fa-star-o');
                }
            }
            if (!rating) {
                return this.$el.find('span').removeClass('fa-star').addClass('fa-star-o');
            }
        };

        return Starrr;

    })();
    return $.fn.extend({
        starrr: function() {
            var args, option;

            option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            return this.each(function() {
                var data;

                data = $(this).data('star-rating');
                if (!data) {
                    $(this).data('star-rating', (data = new Starrr($(this), option)));
                }
                if (typeof option === 'string') {
                    return data[option].apply(data, args);
                }
            });
        }
    });
})(window.jQuery, window);

$(function() {
    return $(".starrr").starrr();
});

$(document).ready(function() {

    var correspondence = ["", "Quá tệ", "Tệ", "Chấp nhận được", "Tốt", "Tuyệt vời"];

    $('.ratable').on('starrr:change', function(e, value) {

        $(this).closest('.evaluation').children('#count').val(value);
        $(this).closest('.evaluation').children('#meaning').html(correspondence[value]);

        var currentval = $(this).closest('.evaluation').children('#count').html();

        var target = $(this).closest('.evaluation').children('.indicators');
        target.css("color", "black");
        target.children('.rateval').val(currentval);
        target.children('#textwr').html(' ');

        if (value < 3) {
            target.css("color", "red").show();
            target.children('#textwr').text('What can be improved?');
        } else {
            if (value > 3) {
                target.css("color", "green").show();
                target.children('#textwr').html('What was done correctly?');
            } else {
                target.hide();
            }
        }
    });

    $('#hearts-existing').on('starrr:change', function(e, value) {
        $('#count-existing').html(value);
    });
});
// end rating review

// show - hide button comment
$(document).ready(function() {
    $("#button").click(function() {
        $("#writeComment").toggle();
    });
});

// rating comment
var notificationsWrapper = $('.dropdown-notifications');
var notificationsCount = $('.count-notification-circle');
var count = parseInt($('.count-notification-circle').text());
var pusher = new Pusher('42b42f482ce67060fc10', { cluster: 'ap1' });

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('comment-review');

// Bind a function to a Event (the full Laravel class)
channel.bind('App\\Events\\CommentPusherEvent', function(data) {
    var stars = '';
    switch (parseInt(data.star)) {
        case 1:
            stars = '<i class="fa fa-stars"></i>';
            break;
        case 2:
            stars = '<i class="fa fa-star"></i><i class="fa fa-star"></i>';
            break;
        case 3:
            stars = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class=\"fa fa-star"></i>';
            break;
        case 4:
            stars = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
            break;
        case 5:
            stars = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
            break;
        default:
            stars = `Không có đánh giá`;

    }
    var newNotificationHtml = `<li class = "m-menu__item dropdown-notifications-item"
            aria - haspopup = "true">
            <p class = "notification-title"> ` + data.name + `</p>
            <div class = "comment-rating"> ` + stars + ` </div>
            <p class = "block-ellipsis"> ` + data.email + `</p>
            <href = ""> ` + data.content + ` </a>
            <a href = ""> ` + data.tour_name + `</a>
            </li>
        `;
    notificationsWrapper.prepend(newNotificationHtml);
    count += 1;
    notificationsCount.text(count);
});
