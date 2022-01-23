@extends('layouts.front')

@section('content')
<section class="center">
    <div class="container">
        <h1>সদস্যের তথ্য সংশোধন করুন</h1>
        <form id="holder_form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-area">
                <label for="full_name">সদস্যের পুরো নাম</label>
                <input id="full_name" name="name" type="text" placeholder="সদস্যের পুরো নাম" value="{{ $holder->name }}">
            </div>
            <div class="input-area">
                <label for="address">সদস্যের ঠিকানা</label>
                <textarea name="address" name="address" id="address" placeholder="সদস্যের ঠিকানা">{{ $holder->address }}</textarea>
            </div>
            <div class="input-area">
                <label for="text">সদস্যের পলিসি নং</label>
                <input id="text" name="policy" type="text" placeholder="সদস্যের পলিসি নং" readonly value="{{ $holder->policy }}">
            </div>
            <div class="input-area">
                <label for="mobile">সদস্যের মোবাইল নং</label>
                <input id="mobile" name="phone" type="text" placeholder="সদস্যের মোবাইল নং" value="{{ $holder->phone }}">
            </div>
            <div class="input-area">
                <label for="id_card">সদস্যের আই ডি কার্ড নং</label>
                <input id="id_card" name="id_card" type="number" placeholder="সদস্যের আই ডি কার্ড নং" value="{{ $holder->id_card }}">
            </div>
            <div class="input-area">
                <label for="balance">সদস্যের বর্তমান ব্যালেন্স</label>
                <input id="balance" name="balance" type="number" placeholder="সদস্যের বর্তমান ব্যালেন্স" value="{{ $holder->balance }}">
                
            </div>
            <div class="join-date">
                <h5 class="text-start">ভর্তির তারিখ</h5>
                <div class="selections d-flex">
                    <div class="input-area w-100 me-2">
                        <label for="day">তারিখ</label>
                        <select id="day" name="day" class="custom-select bn">
                            <script>
                                function dayFn(value) {
                                    if(value === {{ \Carbon\Carbon::parse($holder->joining_date)->format('d') }}) {
                                        return `<option selected value="${value}">${value}</option>`;
                                    } else {
                                        return `<option value="${value}">${value}</option>`;
                                    }
                                }
                                for(let dayI = 1; dayI <= 31; dayI++) {
                                    document.write( dayFn(dayI) )
                                }
                            </script>
                        </select>
                    </div>
    
                    <div class="input-area w-100 me-2">
                        <label for="month">মাস</label>
                        <select name="month" id="month" class="custom-select bn">
    
                            <script>
                                let months = [
                                    'জানুয়ারী',
                                    'ফেব্রুয়ারী',
                                    'মার্চ',
                                    'এপ্রিল',
                                    'মে',
                                    'জুন',
                                    'জুলাই',
                                    'আগস্ট',
                                    'সেপ্টেম্বর',
                                    'অক্টবর',
                                    'নভেম্বর',
                                    'ডিসেম্বর',
                                ]
                                let thisMonth = (new Date()).getMonth();
                                function monthFn(value) {
                                    if(value === ({{ \Carbon\Carbon::parse($holder->joining_date)->format('m') }})) {
                                        return `<option selected value="${value}">${months[value - 1]}</option>`;
                                    } else {
                                        return `<option value="${value}">${months[value - 1]}</option>`;
                                    }
                                }
    
                                for(let monthI = 1; monthI <=12; monthI++) {
                                    document.write( monthFn(monthI) );
                                }
                            </script>
    
                        </select>
                    </div>
    
                    <div class="input-area w-100">
                        <label for="year">বছর</label>
                        <select id="year" name="year" class="custom-select bn">
                            
                            <script>
                                let thisYear = (new Date()).getFullYear();
                                function thisYearFun(value) {
                                    if(value === {{ \Carbon\Carbon::parse($holder->joining_date)->format('Y') }}) {
                                        return `<option selected value="${value}">${value}</option>`;
                                    } else {
                                        return `<option value="${value}">${value}</option>`;
                                    }
                                }
                                for(let yearI = (thisYear - 20); yearI <= thisYear; yearI++) {
                                    document.write(thisYearFun(yearI))
                                }
                            </script>
                        </select>
                    </div>
                </div>
            </div>
            <div class="image-upload">
                <div class="img">
                    <img id="output" src="{{ asset( $holder->photo ? $holder->photo : 'front/images/profile.jpg') }}" alt="img">
                </div>
                <div class="content">
                    <label for="image">সদস্যের ছবি যুক্ত করুন</label>
                    <input name="photo" accept="image/*" type="file" id="image">
                </div>
            </div>
            <div class="btn-area text-start">
                <button id="add-btn" class="btn-primary btn" type="submit">তথ্য সংশধন করুন</button>
                <input type="hidden" name="id" value="{{ $holder->id }}">
            </div>
        </form>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="add-user-status" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-body">
          <div class="text-center">
              <h3>সদস্যের তথ্য সংশধিত হয়েছে</h3>

            </div>
        </div>
        <div class="modal-footer">
            <div class="text-center">
                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary">ঠিক আছে</a>

            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('custom_js')
<script>

    var myModal = new bootstrap.Modal(document.getElementById('add-user-status'))    
    document.getElementById('holder_form').addEventListener('submit', function(e) {
        let myForm = $('#holder_form');
        e.preventDefault();
        let formData = new FormData();
        formData.append('photo', $('input[name="photo"]')[0].files[0] );
        let formTextContent = $( '#holder_form' ).serializeArray();
        for(data of formTextContent) {
            formData.append(data.name, data.value );
        }
        
        $.ajax({
            method: 'POST',
            url: "{{ route('holder.update') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                myModal.show();
                myForm.find('small').remove();
                myForm.find('input, textarea').children('small').hide();
            },
            error: function(error) {
                console.log(error);
                let errors = error.responseJSON.errors;
                function errorTag(massage) {
                    return `<small>${massage}</small>`;
                }
                Object.keys(errors).forEach(function(key) {
                    if(key === 'policy') {
                        if(errors.policy[0] == "The policy has already been taken.") {
                            myForm.find('[name="'+ key +'"]').parents('.input-area').append( errorTag('এই পলিসি নম্বরটি ফাঁকা নেই') )
                        } else {
                            myForm.find('[name="'+ key +'"]').parents('.input-area').append( errorTag('এই ঘরটি অবশ্যই পুরণ করুন') )
                        }
                    } else {
                        myForm.find('[name="'+ key +'"]').parents('.input-area').append( errorTag('এই ঘরটি অবশ্যই পুরণ করুন') )
                    }
                }); 
            }
        });
    })

</script>
@endsection