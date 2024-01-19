// フォーム内のEmailアドレスinputのnameを記載
var mailName = 'Email';

// メールフォームバックエンドのURL
// var systemUrl = '/contact-mail/';

// 送信完了ページのURL
// var thanksUrl = '/contact-thanks/';


$(function ($) {
  $("#referrer").val(document.referrer);

  $('.hissuVal').focusin(function (e) {
    $(this).removeClass('borderRed');
  });

  $(".errorMessage").click(function(){
    $(".errorMessage").fadeOut();
  });

  $(".form").submit(function(){
    
    var postData = $(this).serializeArray();

    // var checkFlag = false;

    // for (let i = 0; i < postData.length; ++i) {
    //   var item = postData[i];

    //   if (item.name && item.name == 'check' && item.value) {
    //     checkFlag = true;
    //   }
    // }
   
    // if (checkFlag) {
      var errorFlag = false;

      var isEmailAddress = false;

      $('.hissuVal').each(function() {
        if (!$(this).val()) {
          $(this).addClass('borderRed');
          errorFlag = true;
          errorMessagShow('必須項目を入力してください');
        }

        if ($(this).attr("name") == mailName) {
          isEmailAddress = isEmail($(this).val());

          if (!isEmailAddress) $(this).addClass('borderRed');
          errorMessagShow('メールアドレスの形式が正しくありません');
        }
      });

      // if (errorFlag) {
        
      // }

      // if (!isEmailAddress) {
        
      // }

      if (errorFlag || !isEmailAddress) return false;
    // }


    // $.ajax({
    //   url : systemUrl,
    //   type: 'POST',
    //   dataType: 'json',
    //   data: postData
    // })
    // .done(function(data){
    //   if (data.errflg == 0) {
    //     if (!checkFlag) {
    //       window.location.href = thanksUrl
    //     }
    //   } else {
    //     errorMessagShow(data.errorMessage);
    //   }
    // })

    // if (!checkFlag) {
    //   return false;
    // }
  });
});

function isEmail (emailAddress) {
  var reg = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}\.[A-Za-z0-9]{1,}$/;

  if (reg.test(emailAddress)) {
    return true;
  } else {
    return false;
  }
}

function errorMessagShow (text) {
  $(".errorMessage").empty();
  $(".errorMessage").html(text);
  $(".errorMessage").fadeIn();

  setTimeout(function () {
    $(".errorMessage").fadeOut();
  }, 5000);
}
