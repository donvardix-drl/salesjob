import Cookies from "js-cookie";

function jobs_list_init() {
    $('.job_item').each(function(){
        let apply_later = Cookies.get('jobs_apply_later')
        let not_for_me = Cookies.get('jobs_not_for_me')

        if (undefined !== apply_later) {
            apply_later = JSON.parse(apply_later)
            let id = $(this).data('id')

            if (-1 !== apply_later.indexOf(id)) {
                if ($(this).hasClass('single-job')) {
                    $(this).find('.apply_later').text('Added')
                } else {
                    $(this).hide()
                }
            }
        }

        if (undefined !== not_for_me) {
            not_for_me = JSON.parse(not_for_me)
            let id = $(this).data('id')

            if (-1 !== not_for_me.indexOf(id)) {
                if ($(this).hasClass('single-job')) {
                    $(this).find('.not_for_me').text('Added')
                } else {
                    $(this).hide()
                }
            }
        }
    });
}

$(document).ready(function(){
    jobs_list_init()

    $('.apply_later').on('click', function(){
        let apply_later = Cookies.get('jobs_apply_later')
        let not_for_me = Cookies.get('jobs_not_for_me')
        let job_item = $(this).closest('.job_item')
        let id = job_item.data('id')

        if (job_item.hasClass('single-job')) {
            $(this).text('Added')
        } else {
            job_item.hide()
        }

        if (undefined === apply_later) {
            Cookies.set('jobs_apply_later', JSON.stringify([id]), { expires: 30 })
        } else {
            apply_later = JSON.parse(apply_later)
            if (-1 === apply_later.indexOf(id)) {
                apply_later.push(id)
                Cookies.set('jobs_apply_later', JSON.stringify(apply_later), { expires: 30 })
            }
        }

        if (undefined !== not_for_me) {
            not_for_me = JSON.parse(not_for_me)
            if (-1 !== not_for_me.indexOf(id)) {
                let index = not_for_me.indexOf(id)
                not_for_me.splice(index, 1)

                Cookies.set('jobs_not_for_me', JSON.stringify(not_for_me), { expires: 30 })
                $(this).siblings('.not_for_me').text('Not for me')
            }
        }
    });

    $('.not_for_me').on('click', function(){
        let apply_later = Cookies.get('jobs_apply_later')
        let not_for_me = Cookies.get('jobs_not_for_me')
        let job_item = $(this).closest('.job_item')
        let id = job_item.data('id')

        if (job_item.hasClass('single-job')) {
            $(this).text('Added')
        } else {
            job_item.hide()
        }

        if (undefined === not_for_me) {
            Cookies.set('jobs_not_for_me', JSON.stringify([id]), { expires: 30 })
        } else {
            not_for_me = JSON.parse(not_for_me)
            if (-1 === not_for_me.indexOf(id)) {
                not_for_me.push(id)
                Cookies.set('jobs_not_for_me', JSON.stringify(not_for_me), { expires: 30 })
            }
        }

        if (undefined !== apply_later) {
            apply_later = JSON.parse(apply_later)
            if (-1 !== apply_later.indexOf(id)) {
                let index = apply_later.indexOf(id)
                apply_later.splice(index, 1)

                Cookies.set('jobs_apply_later', JSON.stringify(apply_later), { expires: 30 })
                $(this).siblings('.apply_later').text('Apply Later')
            }
        }
    });
});
