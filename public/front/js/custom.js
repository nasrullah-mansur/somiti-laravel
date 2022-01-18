$(document).ready(function() {
    "use strict";

    // AJAX SETUP;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
        }
    });

    // $('.header .content .mobile').on('click', function() {
    //     $('.header .content .list').toggleClass('active');
    //     $('body').toggleClass('overflow-hidden')
    //     $('.body-overlay').fadeToggle();
    //     let img = ($(this).find('img').attr('src')).split('/');
    //     let imgName;

    //     if(img.includes('menu.png')){
    //         img[img.length - 1] = 'close.png';
    //     } else {
    //         img[img.length - 1] = 'menu.png';
    //     }
        
    //     imgName = img.join('/');
    //     $(this).find('img').attr('src', imgName);

    // })


    $('.input-area .show-pass').on('click', function() {
        let inputItem = $(this).parents('.input-area').find('input');
        $(this).toggleClass('fa-eye fa-eye-slash');
        inputItem.attr('type', function() {
            if(inputItem.attr('type') === 'text') {
                return 'password';
            } else {
                return 'text';
            }
        });
    })

    let allSelectOptions = document.querySelectorAll('.bn option');
    let anotherBn = document.querySelectorAll('.bn-text');

    let allBn = (Array.from(allSelectOptions)).concat(Array.from(anotherBn));
   
    // allBn.forEach(function(elem) {
    //     let elemArr = elem.textContent;
    //     elemArr = elemArr.replace(/0/g, '০');
    //     elemArr = elemArr.replace(/1/g, '১');
    //     elemArr = elemArr.replace(/2/g, '২');
    //     elemArr = elemArr.replace(/3/g, '৩');
    //     elemArr = elemArr.replace(/4/g, '৪');
    //     elemArr = elemArr.replace(/5/g, '৫');
    //     elemArr = elemArr.replace(/6/g, '৬');
    //     elemArr = elemArr.replace(/7/g, '৭');
    //     elemArr = elemArr.replace(/8/g, '৮');
    //     elemArr = elemArr.replace(/9/g, '৯');
        
    //     elem.textContent = elemArr;
    // })

    function loadFile(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    };

    let image = document.getElementById('image'); null

    if(image) {
        image.addEventListener('change', loadFile)
    }


    if(document.querySelector('.table')) {
        document.querySelector('.table').addEventListener('click', function(e) {
            let deleteBtn = e.target.classList.contains('delete-btn') || e.target.parentElement.classList.contains('delete-btn');
            if(deleteBtn) {
                let confirmVal = confirm("আপনি কি সত্যিই পরিবর্তন করতে ইচ্ছুক ???");
                if(!confirmVal) {
                    e.preventDefault();
                }
            }
        })
    }


    $('.input-area .custom-select').select2();
    $('.data-table-set').DataTable();


});