import Cookies from 'js-cookie';

function user_list_count() {
    let apply_later = Cookies.get('jobs_apply_later')
    let not_for_me = Cookies.get('jobs_not_for_me')

    if (undefined !== apply_later) {
        apply_later = JSON.parse(apply_later)
        $('#count_apply_later').text(apply_later.length)
    }

    if (undefined !== not_for_me) {
        not_for_me = JSON.parse(not_for_me)
        $('#count_not_for_me').text(not_for_me.length)
    }
}

function check_cookies() {
    let check_cookies = Cookies.get('jobs_check_cookies')
    let jobs_total = $('#count_total').text()
    if (undefined === check_cookies) {
        Cookies.set('jobs_check_cookies', jobs_total, { expires: 30 })
    } else if ( check_cookies !== jobs_total ) {
        Cookies.set('jobs_check_cookies', jobs_total, { expires: 30 })
        Cookies.remove('jobs_apply_later')
        Cookies.remove('jobs_not_for_me')
    }
}

$(document).ready(function(){
    user_list_count()
    check_cookies()

    $('.apply_later').on('click', function(){
        $(this).text('Added')

        let apply_later = Cookies.get('jobs_apply_later')
        let not_for_me = Cookies.get('jobs_not_for_me')
        let id = $(this).closest('.job_item').data('id')

        if (undefined === apply_later) {
            Cookies.set('jobs_apply_later', JSON.stringify([id]), { expires: 7 })
        } else {
            apply_later = JSON.parse(apply_later)
            if (-1 === apply_later.indexOf(id)) {
                apply_later.push(id)
                Cookies.set('jobs_apply_later', JSON.stringify(apply_later), { expires: 7 })
            }
        }

        if (undefined !== not_for_me) {
            not_for_me = JSON.parse(not_for_me)
            if (-1 !== not_for_me.indexOf(id)) {
                let index = not_for_me.indexOf(id)
                not_for_me.splice(index, 1)

                Cookies.set('jobs_not_for_me', JSON.stringify(not_for_me), { expires: 7 })
                $(this).siblings('.not_for_me').text('Not for me')
            }
        }
        user_list_count()
    });

    $('.not_for_me').on('click', function(){
        $(this).text('Added')

        let apply_later = Cookies.get('jobs_apply_later')
        let not_for_me = Cookies.get('jobs_not_for_me')
        let id = $(this).closest('.job_item').data('id')

        if (undefined === not_for_me) {
            Cookies.set('jobs_not_for_me', JSON.stringify([id]), { expires: 7 })
        } else {
            not_for_me = JSON.parse(not_for_me)
            if (-1 === not_for_me.indexOf(id)) {
                not_for_me.push(id)
                Cookies.set('jobs_not_for_me', JSON.stringify(not_for_me), { expires: 7 })
            }
        }

        if (undefined !== apply_later) {
            apply_later = JSON.parse(apply_later)
            if (-1 !== apply_later.indexOf(id)) {
                let index = apply_later.indexOf(id)
                apply_later.splice(index, 1)

                Cookies.set('jobs_apply_later', JSON.stringify(apply_later), { expires: 7 })
                $(this).siblings('.apply_later').text('Apply Later')
            }
        }
        user_list_count()
    });

    $('.apply_later').each(function(){
        let apply_later = Cookies.get('jobs_apply_later')
        let id = $(this).closest('.job_item').data('id')

        if (undefined !== apply_later && -1 !== apply_later.indexOf(id)) {
            $(this).html('Added')
        }
    });

    $('.not_for_me').each(function(){
        let not_for_me = Cookies.get('jobs_not_for_me')
        let id = $(this).closest('.job_item').data('id')

        if (undefined !== not_for_me && -1 !== not_for_me.indexOf(id)) {
            $(this).html('Added')
        }
    });

    $('#jobs_list').on('click', function(e) {
        e.preventDefault()

        $('.job_heading_button h2').text('All Jobs')
        $('.job_heading_button button').addClass('hidden')

        $('.job_item').each(function(){
            $(this).show()
        })

        $('.apply_now').addClass('hidden')
        $('.not_for_me').removeClass('hidden')
        $('.apply_later').removeClass('hidden')
    });

    $('#apply_later_list').on('click', function(e) {
        e.preventDefault()

        $('.job_heading_button h2').text('Apply Now List')
        $('.job_heading_button button').removeClass('hidden')
        let apply_later = Cookies.get('jobs_apply_later')
        if (undefined !== apply_later) {
            apply_later = JSON.parse(apply_later)
        }

        $('.job_item').each(function(){
            let id = $(this).data('id')

            if (undefined !== apply_later && -1 !== apply_later.indexOf(id)) {
                $(this).show()
            } else {
                $(this).hide()
            }
        })

        $('.apply_now').removeClass('hidden')
        $('.not_for_me').addClass('hidden')
        $('.apply_later').addClass('hidden')
    });

    $('#not_for_me_list').on('click', function(e) {
        e.preventDefault()

        $('.job_heading_button h2').text('Not For Me List')
        $('.job_heading_button button').addClass('hidden')
        let not_for_me = Cookies.get('jobs_not_for_me')
        if (undefined !== not_for_me) {
            not_for_me = JSON.parse(not_for_me)
        }

        $('.job_item').each(function(){
            let id = $(this).data('id')

            if (undefined !== not_for_me && -1 !== not_for_me.indexOf(id)) {
                $(this).show()
            } else {
                $(this).hide()
            }
        })

        $('.apply_now').removeClass('hidden')
        $('.not_for_me').addClass('hidden')
        $('.apply_later').addClass('hidden')
    });
});
