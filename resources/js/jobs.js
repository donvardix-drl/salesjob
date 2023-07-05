import Cookies from 'js-cookie';
import { Crisp } from 'crisp-sdk-web';

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

function pagination_init(total = false) {
    let pagination = $('.pagination')
    let current = pagination.data('current')
    let pageSize = pagination.data('pagesize')

    if (false === total) {
        total = pagination.data('total')
    }
    let pages = Math.ceil(total/ pageSize)


    $('.job_item').each(function() {

    });

    pagination.html('')
    if (1 < pages) {
        for (let i = 1; i <= pages; i++) {
            if (i === current) {
                pagination.append('<li class="page-item active"><span class="page-link">' + i + '</span></li>')
            } else {
                pagination.append('<li class="page-item"><span class="page-link">' + i + '</span></li>')
            }
        }
        $('.page-item').on('click', function(){
            let page = $(this).text()
            $('.pagination').attr('data-current', page)
            $(this).addClass('active').siblings().removeClass('active')

            jobs_list_init(false)
        });
    }
}

function jobs_list_init(pag_init = true) {
    let pagination = $('.pagination')
    let current = pagination.attr('data-current')
    let pageSize = pagination.attr('data-pagesize')
    let total = pagination.attr('data-total')
    let job_item = $('.job_item')
    let i = 0
    job_item.show()
    job_item.each(function(){
        i++
        let apply_later = Cookies.get('jobs_apply_later')
        let not_for_me = Cookies.get('jobs_not_for_me')

        if (undefined !== apply_later) {
            apply_later = JSON.parse(apply_later)
            let id = $(this).data('id')

            if (-1 !== apply_later.indexOf(id)) {
                $(this).hide()
                total--
                i--
            }
        }

        if (undefined !== not_for_me) {
            not_for_me = JSON.parse(not_for_me)
            let id = $(this).data('id')

            if (-1 !== not_for_me.indexOf(id)) {
                $(this).hide()
                total--
                i--
            }
        }

        if ((pageSize * current) - pageSize < i && i <= pageSize * current) {} else {
            $(this).hide()
        }
    });
    if (pag_init) {
        pagination.attr('data-total', total);
        pagination_init(total);
    }
}

$(document).ready(function(){
    Crisp.configure($("meta[name='crisp-website-id']").attr("content"))

    user_list_count()
    jobs_list_init()

    $('.apply_later').on('click', function(){
        let apply_later = Cookies.get('jobs_apply_later')
        let not_for_me = Cookies.get('jobs_not_for_me')
        let job_item = $(this).closest('.job_item')
        let id = job_item.data('id')

        job_item.hide()

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
            }
        }
        user_list_count()
        jobs_list_init(false)
    });

    $('.not_for_me').on('click', function(){
        let apply_later = Cookies.get('jobs_apply_later')
        let not_for_me = Cookies.get('jobs_not_for_me')
        let job_item = $(this).closest('.job_item')
        let id = job_item.data('id')

        job_item.hide()

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
            }
        }
        user_list_count()
        jobs_list_init(false)
    });

    $('#jobs_list').on('click', function(e) {
        e.preventDefault()

        let apply_later = Cookies.get('jobs_apply_later')
        if (undefined !== apply_later && '[]' !== apply_later) {
            $('.job_heading_button button').addClass('hidden')
        }
        $('.job_heading_button h2').text('All Jobs')

        jobs_list_init(false)

        $('.apply_now').addClass('hidden')
        $('.not_for_me').removeClass('hidden')
        $('.apply_later').removeClass('hidden')
        $('.pagination ').removeClass('hidden')
        $('.job_item_content ').removeClass('hidden')

        $('.marketing_list_links li').removeClass('hidden')
    });

    $('#apply_later_list').on('click', function(e) {
        e.preventDefault()

        $('.job_heading_button h2').text('Apply Now List')
        let apply_later = Cookies.get('jobs_apply_later')
        if (undefined !== apply_later) {
            apply_later = JSON.parse(apply_later)

            if (0 < apply_later.length) {
                $('.job_heading_button button').removeClass('hidden')
            }
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
        $('.pagination ').addClass('hidden')
        $('.job_item_content ').addClass('hidden')

        $('.marketing_list_links li').removeClass('hidden')
        $(this).closest('li').addClass('hidden')
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
        $('.pagination ').addClass('hidden')
        $('.job_item_content ').removeClass('hidden')

        $('.marketing_list_links li').removeClass('hidden')
        $(this).closest('li').addClass('hidden')
    });

    $('.apply_now').on('click', function() {
        Crisp.message.sendText('Jobs:\n' + document.location.href + 'job/' + $(this).closest('.job_item').data('id'));
        Crisp.chat.open()
    });

    $('#apply_now_all_jobs').on('click', function() {
        let apply_later = Cookies.get('jobs_apply_later')

        if (undefined !== apply_later) {
            apply_later = JSON.parse(apply_later)

            let crispText = 'Jobs:'
            for (let i = 0; i < apply_later.length; i++) {
                crispText += '\n' + document.location.href + 'job/' + apply_later[i]
            }

            Crisp.message.sendText(crispText)
        }

        Crisp.chat.open()
    });
});
