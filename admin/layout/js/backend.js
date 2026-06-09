

$(function () {
    'use strict';



    $('.toggle-info').click(function () {
        $(this).toggleClass('selected');

        // تغيير الأيقونة
        if ($(this).hasClass('selected')) {
            $(this).html('<i class="bi bi-minus-lg"></i>');
        } else {
            $(this).html('<i class="bi bi-plus-lg"></i>');
        }

        // الوصول الصحيح للكارد مع استخدام stop لمنع تداخل الحركات وسرعة منطقية (300ms)
        $(this).closest('.panel').find('.card').stop(true, true).slideToggle(300);
    });

    // 1. Placeholder: إخفاء وإظهار النص المساعد
    $('[placeholder]').focus(function () {
        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    }).blur(function () {
        $(this).attr('placeholder', $(this).attr('data-text'));
    });

    // 2. Asterisk: إضافة النجمة للحقول المطلوبة
    $('input').each(function () {
        if ($(this).attr('required') === 'required') {
            $(this).after('<span class="asterisk">*</span>');
        }
    });

    // 3. Confirm: رسالة تأكيد الحذف
    $(document).on('click', '.confirm', function () {
        return confirm('هل أنت متأكد أنك تريد الحذف؟');
    });

    // 4. التبديل الذكي (Toggle) عند النقر على قسم التصنيف نفسه
    $(document).on('click', '.cat', function (e) {

        // استثناء الأزرار والروابط من النقر (عشان يشتغل رابط Edit و Delete)
        if ($(e.target).is('a') || $(e.target).parent().is('a') || $(e.target).is('i') || $(e.target).is('.btn')) {
            return;
        }

        // التبديل بين الظهور والاختفاء للجزء الداخلي
        $(this).find('.full-view').fadeToggle(200);
    });

    // 5. التحكم العام من خلال أزرار View (Full / Classic)
    $('.option span').click(function () {
        // تمييز الزر المختار
        $(this).addClass('active').siblings('span').removeClass('active');

        if ($(this).data('view') === 'full') {
            $('.cat .full-view').fadeIn(200);
        } else {
            $('.cat .full-view').fadeOut(200);
        }
    });
});