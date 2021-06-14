// source --> https://icarefurnishers.com/wp-content/plugins/wp-user-frontend/assets/js/frontend-form.min.js?ver=5.3.2 
!function(a,b){a.fn.listautowidth=function(){return this.each(function(){var b=a(this).width(),c=b/a(this).children("li").length;a(this).children("li").each(function(){var b=a(this).outerWidth(!0)-a(this).width();a(this).width(c-b)})})},b.WP_User_Frontend={init:function(){this.enableMultistep(this),a(".wpuf-form").on("click","img.wpuf-clone-field",this.cloneField),a(".wpuf-form").on("click","img.wpuf-remove-field",this.removeField),a(".wpuf-form").on("click","a.wpuf-delete-avatar",this.deleteAvatar),a(".wpuf-form").on("click","a#wpuf-post-draft",this.draftPost),a(".wpuf-form").on("click","button#wpuf-account-update-profile",this.account_update_profile),a(".wpuf-form-add").on("submit",this.formSubmit),a("form#post").on("submit",this.adminPostSubmit),a(".wpuf-form").on("step-change-fieldset",function(a,b,c){if(wpuf_plupload_items.length)for(var d=wpuf_plupload_items.length-1;d>=0;d--)wpuf_plupload_items[d].refresh();if(wpuf_map_items.length)for(var d=wpuf_map_items.length-1;d>=0;d--)google.maps.event.trigger(wpuf_map_items[d].map,"resize"),wpuf_map_items[d].map.setCenter(wpuf_map_items[d].center)}),this.ajaxCategory(),a(':submit[name="wpuf_user_subscription_cancel"]').click(function(b){b.preventDefault(),swal({text:wpuf_frontend.cancelSubMsg,type:"warning",showCancelButton:!0,confirmButtonColor:"#d54e21",confirmButtonText:wpuf_frontend.delete_it,cancelButtonText:wpuf_frontend.cancel_it,confirmButtonClass:"btn btn-success",cancelButtonClass:"btn btn-danger"}).then(function(b){if(!b)return!1;a("#wpuf_cancel_subscription").submit()})})},check_pass_strength:function(){var b=a("#pass1").val();if(a("#pass-strength-result").show(),a("#pass-strength-result").removeClass("short bad good strong"),!b)return a("#pass-strength-result").html("&nbsp;"),void a("#pass-strength-result").hide();if(void 0!==wp.passwordStrength)switch(wp.passwordStrength.meter(b,wp.passwordStrength.userInputBlacklist(),b)){case 2:a("#pass-strength-result").addClass("bad").html(pwsL10n.bad);break;case 3:a("#pass-strength-result").addClass("good").html(pwsL10n.good);break;case 4:a("#pass-strength-result").addClass("strong").html(pwsL10n.strong);break;case 5:a("#pass-strength-result").addClass("short").html(pwsL10n.mismatch);break;default:a("#pass-strength-result").addClass("short").html(pwsL10n.short)}},enableMultistep:function(c){var d=this,e=0,f=a(':hidden[name="wpuf_multistep_type"]').val();if(null!=f){if(a("fieldset.wpuf-multistep-fieldset").find(".wpuf-multistep-prev-btn").first().remove(),a("fieldset.wpuf-multistep-fieldset").find(".wpuf-multistep-next-btn").last().remove(),a(".wpuf-form fieldset").removeClass("field-active").first().addClass("field-active"),"progressive"==f&&0!=a(".wpuf-form .wpuf-multistep-fieldset").length){a("fieldset.wpuf-multistep-fieldset legend").first();a(".wpuf-multistep-progressbar").html('<div class="wpuf-progress-percentage"></div>');var g=a(".wpuf-multistep-progressbar"),h=a(".wpuf-progress-percentage");a(".wpuf-multistep-progressbar").progressbar({change:function(){h.text(g.progressbar("value")+"%")}}),a(".wpuf-multistep-fieldset legend").hide()}else a(".wpuf-form").each(function(){var b=a(this),c=a(".wpuf-multistep-progressbar",b),d="";c.addClass("wizard-steps"),d+='<ul class="wpuf-step-wizard">',a(".wpuf-multistep-fieldset",this).each(function(){d+="<li>"+a.trim(a("legend",this).text())+"</li>",a("legend",this).hide()}),d+="</ul>",c.append(d),a(".wpuf-step-wizard li",c).first().addClass("active-step"),a(".wpuf-step-wizard",c).listautowidth()});this.change_fieldset(e,f),a("fieldset .wpuf-multistep-prev-btn, fieldset .wpuf-multistep-next-btn").click(function(g){if(a(this).hasClass("wpuf-multistep-next-btn")){0!=d.formStepCheck("",a(this).closest("fieldset"))&&c.change_fieldset(++e,f)}else a(this).hasClass("wpuf-multistep-prev-btn")&&c.change_fieldset(--e,f);var h=document.querySelector("form.wpuf-form-add"),i=h.offsetTop;return b.scrollTo({top:i-32,behavior:"smooth"}),!1})}},change_fieldset:function(b,c){var d=a("fieldset.wpuf-multistep-fieldset").eq(b);a("fieldset.wpuf-multistep-fieldset").removeClass("field-active").eq(b).addClass("field-active"),a(".wpuf-step-wizard li").each(function(){a(this).index()<=b?"step_by_step"==c?a(this).addClass("passed-wpuf-ms-bar"):a(".wpuf-ps-bar",this).addClass("passed-wpuf-ms-bar"):"step_by_step"==c?a(this).removeClass("passed-wpuf-ms-bar"):a(".wpuf-ps-bar",this).removeClass("passed-wpuf-ms-bar")}),a(".wpuf-step-wizard li").removeClass("wpuf-ms-bar-active active-step completed-step"),a(".passed-wpuf-ms-bar").addClass("completed-step").last().addClass("wpuf-ms-bar-active"),a(".wpuf-ms-bar-active").addClass("active-step");var e=a("fieldset.wpuf-multistep-fieldset").eq(b).find("legend").text();if(e=a.trim(e),"progressive"==c&&0!=a(".wpuf-form .wpuf-multistep-fieldset").length){var f=100*(b+1)/a("fieldset.wpuf-multistep-fieldset").length,f=Number(f.toFixed(2));a(".wpuf-multistep-progressbar").progressbar({value:f}),a(".wpuf-progress-percentage").text(e+" ("+f+"%)")}a(".wpuf-form").trigger("step-change-fieldset",[b,d])},ajaxCategory:function(){var b=".category-wrap";a(b).on("change",".cat-ajax",function(){currentLevel=parseInt(a(this).parent().attr("level")),WP_User_Frontend.getChildCats(a(this),"lvl",currentLevel+1,b,"category")})},getChildCats:function(b,c,d,e,f){cat=a(b).val(),results_div=c+d,f=void 0!==f?f:"category",field_attr=a(b).siblings("span").data("taxonomy"),a.ajax({type:"post",url:wpuf_frontend.ajaxurl,data:{action:"wpuf_get_child_cat",catID:cat,nonce:wpuf_frontend.nonce,field_attr:field_attr},beforeSend:function(){a(b).parent().parent().next(".loading").addClass("wpuf-loading")},complete:function(){a(b).parent().parent().next(".loading").removeClass("wpuf-loading")},success:function(e){a(b).parent().nextAll().each(function(){a(this).remove()}),""!=e&&(a(b).parent().addClass("hasChild").parent().append('<div id="'+c+d+'" level="'+d+'"></div>'),b.parent().parent().find("#"+results_div).html(e).slideDown("fast"))}})},cloneField:function(b){b.preventDefault();var c=a(this).closest("tr"),d=c.clone();d.find("input").val(""),d.find(":checked").attr("checked",""),c.after(d)},removeField:function(){var b=a(this).closest("tr");b.siblings().andSelf().length>1&&b.remove()},adminPostSubmit:function(b){b.preventDefault();var c=a(this);if(WP_User_Frontend.validateForm(c))return!0},draftPost:function(b){b.preventDefault();var c=a(this),d=a(this).closest("form"),e=d.serialize()+"&action=wpuf_draft_post",f=d.find('input[type="hidden"][name="post_id"]').val(),g=[];a(".wpuf-rich-validation").each(function(b,c){var c=a(c),d=c.data("id"),e=c.data("name"),f=a.trim(tinyMCE.get(d).getContent());g.push(e+"="+encodeURIComponent(f))}),e=e+"&"+g.join("&"),c.after(' <span class="wpuf-loading"></span>'),a.post(wpuf_frontend.ajaxurl,e,function(b){if(void 0===f){var e='<input type="hidden" name="post_id" value="'+b.post_id+'">';e+='<input type="hidden" name="post_date" value="'+b.date+'">',e+='<input type="hidden" name="post_author" value="'+b.post_author+'">',e+='<input type="hidden" name="comment_status" value="'+b.comment_status+'">',d.append(e)}c.next("span.wpuf-loading").remove(),c.after('<span class="wpuf-draft-saved">&nbsp; Post Saved</span>'),a(".wpuf-draft-saved").delay(2500).fadeOut("fast",function(){a(this).remove()})})},account_update_profile:function(b){b.preventDefault();var c=a(this).closest("form");a.post(wpuf_frontend.ajaxurl,c.serialize(),function(a){a.success?(c.find(".wpuf-error").hide(),c.find(".wpuf-success").show()):(c.find(".wpuf-success").hide(),c.find(".wpuf-error").show(),c.find(".wpuf-error").text(a.data))})},formStepCheck:function(a,b){var c=b;c.find("input[type=submit]");return form_data=WP_User_Frontend.validateForm(c),0==form_data&&WP_User_Frontend.addErrorNotice(self,"bottom"),form_data},formSubmit:function(c){c.preventDefault();var d=a(this),e=d.find("input[type=submit]");form_data=WP_User_Frontend.validateForm(d),form_data&&(d.find("li.wpuf-submit").append('<span class="wpuf-loading"></span>'),e.attr("disabled","disabled").addClass("button-primary-disabled"),a.post(wpuf_frontend.ajaxurl,form_data,function(c){if(c.success)a("body").trigger("wpuf:postform:success",c),1==c.show_message?(d.before('<div class="wpuf-success">'+c.message+"</div>"),d.slideUp("fast",function(){d.remove()}),a("html, body").animate({scrollTop:a(".wpuf-success").offset().top-100},"fast")):b.location=c.redirect_to;else{if(void 0!==c.type&&"login"===c.type)return void(confirm(c.error)?b.location=c.redirect_to:(e.removeAttr("disabled"),e.removeClass("button-primary-disabled"),d.find("span.wpuf-loading").remove()));d.find(".g-recaptcha").length>0&&grecaptcha.reset(),swal({html:c.error,type:"warning",showCancelButton:!1,confirmButtonColor:"#d54e21",confirmButtonText:"OK",cancelButtonClass:"btn btn-danger"}),e.removeAttr("disabled")}e.removeClass("button-primary-disabled"),d.find("span.wpuf-loading").remove()}))},validateForm:function(b){var c=!1;error_type="",WP_User_Frontend.removeErrors(b),WP_User_Frontend.removeErrorNotice(b),b.find('[data-required="yes"]:visible').each(function(b,d){var e=a(d).data("type");switch(j="",e){case"rich":var f=a(d).data("id");""===(j=a.trim(tinyMCE.get(f).getContent()))&&(c=!0,WP_User_Frontend.markError(d));break;case"textarea":case"text":""===(j=a.trim(a(d).val()))&&(c=!0,error_type="required",WP_User_Frontend.markError(d,error_type));break;case"password":case"confirm_password":var g=a(d).data("repeat");if(j=a.trim(a(d).val()),""===j&&(c=!0,error_type="required",WP_User_Frontend.markError(d,error_type)),g){var h=a('[data-type="confirm_password"]').eq(0);h.val()!=j&&(c=!0,error_type="mismatch",WP_User_Frontend.markError(h,error_type))}break;case"select":(j=a(d).val())&&"-1"!==j||(c=!0,error_type="required",WP_User_Frontend.markError(d,error_type));break;case"multiselect":null!==(j=a(d).val())&&0!==j.length||(c=!0,error_type="required",WP_User_Frontend.markError(d,error_type));break;case"tax-checkbox":var i=a(d).children().find("input:checked").length;i||(c=!0,error_type="required",WP_User_Frontend.markError(d,error_type));break;case"radio":var i=a(d).find("input:checked").length;i||(c=!0,error_type="required",WP_User_Frontend.markError(d,error_type));break;case"file":var i=a(d).find("ul").children().length;i||(c=!0,error_type="required",WP_User_Frontend.markError(d,error_type));break;case"email":var j=a(d).val();""!==j?WP_User_Frontend.isValidEmail(j)||(c=!0,error_type="validation",WP_User_Frontend.markError(d,error_type)):""===j&&(c=!0,error_type="required",WP_User_Frontend.markError(d,error_type));break;case"url":var j=a(d).val();""!==j&&(WP_User_Frontend.isValidURL(j)||(c=!0,error_type="validation",WP_User_Frontend.markError(d,error_type)))}});var d=b.find('[data-required="yes"][name="google_map"]');if(d){","==a(d).val()&&(c=!0,error_type="required",WP_User_Frontend.markError(d,error_type))}if(c)return WP_User_Frontend.addErrorNotice(b,"end"),!1;var e=b.serialize(),f=[];return a(".wpuf-rich-validation",b).each(function(b,c){var c=a(c),d=c.data("id"),e=c.data("name"),g=a.trim(tinyMCE.get(d).getContent());f.push(e+"="+encodeURIComponent(g))}),e=e+"&"+f.join("&")},addErrorNotice:function(b,c){"bottom"==c?a(".wpuf-multistep-fieldset:visible").append('<div class="wpuf-errors">'+wpuf_frontend.error_message+"</div>"):a(b).find("li.wpuf-submit").append('<div class="wpuf-errors">'+wpuf_frontend.error_message+"</div>")},removeErrorNotice:function(b){a(b).find(".wpuf-errors").remove()},markError:function(b,c){var d="";if(a(b).closest("li").addClass("has-error"),c){switch(d=a(b).closest("li").data("label"),c){case"required":case"mismatch":case"validation":d=d+" "+error_str_obj[c]}a(b).siblings(".wpuf-error-msg").remove(),a(b).after('<div class="wpuf-error-msg">'+d+"</div>")}a(b).focus()},removeErrors:function(b){a(b).find(".has-error").removeClass("has-error"),a(".wpuf-error-msg").remove()},isValidEmail:function(a){return new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i).test(a)},isValidURL:function(a){return new RegExp("^(http://www.|https://www.|ftp://www.|www.|http://|https://){1}([0-9A-Za-z]+.)").test(a)},insertImage:function(b,c){if(a("#"+b).length){var d=new plupload.Uploader({runtimes:"html5,html4",browse_button:b,container:"wpuf-insert-image-container",multipart:!0,multipart_params:{action:"wpuf_insert_image",form_id:a("#"+b).data("form_id")},multiple_queues:!1,multi_selection:!1,urlstream_upload:!0,file_data_name:"wpuf_file",max_file_size:"2mb",url:wpuf_frontend_upload.plupload.url,flash_swf_url:wpuf_frontend_upload.flash_swf_url,filters:[{title:"Allowed Files",extensions:"jpg,jpeg,gif,png,bmp"}]});d.bind("Init",function(a,b){}),d.bind("FilesAdded",function(b,c){var d=a("#wpuf-insert-image-container");a.each(c,function(a,b){d.append('<div class="upload-item" id="'+b.id+'"><div class="progress progress-striped active"><div class="bar"></div></div></div>')}),b.refresh(),b.start()}),d.bind("QueueChanged",function(a){d.start()}),d.bind("UploadProgress",function(b,c){var d=a("#"+c.id);a(".bar",d).css({width:c.percent+"%"}),a(".percent",d).html(c.percent+"%")}),d.bind("Error",function(a,b){alert("Error #"+b.code+": "+b.message)}),d.bind("FileUploaded",function(b,d,e){if(a("#"+d.id).remove(),"error"!==e.response){if("undefined"!=typeof tinyMCE)if("function"!=typeof tinyMCE.execInstanceCommand){var f=tinyMCE.get("post_content_"+c);null!==f&&f.insertContent(e.response)}else tinyMCE.execInstanceCommand("post_content_"+c,"mceInsertContent",!1,e.response);var g=a("#post_content_"+c);g.val(g.val()+e.response)}else alert("Something went wrong")}),d.init()}},deleteAvatar:function(b){b.preventDefault(),confirm(a(this).data("confirm"))&&a.post(wpuf_frontend.ajaxurl,{action:"wpuf_delete_avatar",_wpnonce:wpuf_frontend.nonce},function(){a(b.target).parent().remove(),a("[id^=wpuf-avatar]").css("display","")})},editorLimit:{bind:function(b,c,d){"no"===d?(a("textarea#"+c).keydown(function(a){WP_User_Frontend.editorLimit.textLimit.call(this,a,b)}),a("input#"+c).keydown(function(a){WP_User_Frontend.editorLimit.textLimit.call(this,a,b)}),a("textarea#"+c).on("paste",function(c){var d=a(this);setTimeout(function(){WP_User_Frontend.editorLimit.textLimit.call(d,c,b)},100)}),a("input#"+c).on("paste",function(c){var d=a(this);setTimeout(function(){WP_User_Frontend.editorLimit.textLimit.call(d,c,b)},100)})):setTimeout(function(){tinyMCE.get(c).onKeyDown.add(function(a,c){WP_User_Frontend.editorLimit.tinymce.onKeyDown(a,c,b)}),tinyMCE.get(c).onPaste.add(function(a,c){setTimeout(function(){WP_User_Frontend.editorLimit.tinymce.onPaste(a,c,b)},100)})},1e3)},tinymce:{getStats:function(a){var b=a.getBody(),c=tinymce.trim(b.innerText||b.textContent);return{chars:c.length,words:c.split(/[\w\u2019\'-]+/).length}},onKeyDown:function(b,c,d){var e=WP_User_Frontend.editorLimit.tinymce.getStats(b).words-1;d&&a(".mce-path-item.mce-last",b.container).html("Word Limit : "+e+"/"+d),d&&e>d&&(WP_User_Frontend.editorLimit.blockTyping(c),jQuery(".mce-path-item.mce-last",b.container).html(wpuf_frontend.word_limit))},onPaste:function(a,b,c){var d=a.getContent().split(" ").slice(0,c).join(" ");a.setContent(d),WP_User_Frontend.editorLimit.make_media_embed_code(d,a)}},textLimit:function(b,c){var d=a(this),e=d.val().split(" ");c&&e.length>c?(d.closest(".wpuf-fields").find("span.wpuf-wordlimit-message").html(wpuf_frontend.word_limit),WP_User_Frontend.editorLimit.blockTyping(b)):d.closest(".wpuf-fields").find("span.wpuf-wordlimit-message").html(""),"paste"===b.type&&d.val(e.slice(0,c).join(" "))},blockTyping:function(b){-1!==a.inArray(b.keyCode,[46,8,9,27,13,110,190,189])||65==b.keyCode&&!0===b.ctrlKey||b.keyCode>=35&&b.keyCode<=40||(b.preventDefault(),b.stopPropagation())},make_media_embed_code:function(b,c){a.post(ajaxurl,{action:"make_media_embed_code",content:b},function(a){c.setContent(c.getContent()+c.setContent(a))})}}},a(function(){if(WP_User_Frontend.init(),a("ul.wpuf-payment-gateways").on("click","input[type=radio]",function(b){a(".wpuf-payment-instruction").slideUp(250),a(this).parents("li").find(".wpuf-payment-instruction").slideDown(250)}),a("ul.wpuf-payment-gateways li").find("input[type=radio]").is(":checked")){a("ul.wpuf-payment-gateways li").find("input[type=radio]:checked").parents("li").find(".wpuf-payment-instruction").slideDown(250)}else a("ul.wpuf-payment-gateways li").first().find("input[type=radio]").click()}),a(function(){a('input[name="first_name"], input[name="last_name"]').on("change keyup",function(){var b,c=a.makeArray(a('input[name="first_name"], input[name="last_name"]').map(function(){if(b=a(this).val())return b})).join(" ");a('input[name="display_name"]').val(c)})}),a(function(a){a('.wpuf-form-add input[name="dokan_store_name"]').on("focusout",function(){var b=a(this).val().toLowerCase().replace(/-+/g,"").replace(/\s+/g,"-").replace(/[^a-z0-9-]/g,"");a('input[name="shopurl"]').val(b),a("#url-alart").text(b),a('input[name="shopurl"]').focus()}),a('.wpuf-form-add input[name="shopurl"]').keydown(function(b){a(this).val();-1!==a.inArray(b.keyCode,[46,8,9,27,13,91,109,110,173,189,190])||65==b.keyCode&&!0===b.ctrlKey||b.keyCode>=35&&b.keyCode<=39||(b.shiftKey||(b.keyCode<65||b.keyCode>90)&&(b.keyCode<48||b.keyCode>57))&&(b.keyCode<96||b.keyCode>105)&&b.preventDefault()}),a('.wpuf-form-add input[name="shopurl"]').keyup(function(b){a("#url-alart").text(a(this).val())}),a('.wpuf-form-add input[name="shopurl"]').on("focusout",function(){var b=a(this),c={action:"shop_url",url_slug:b.val(),_nonce:dokan.nonce};""!==b.val()&&a.post(dokan.ajaxurl,c,function(b){0==b?(a("#url-alart").removeClass("text-success").addClass("text-danger"),a("#url-alart-mgs").removeClass("text-success").addClass("text-danger").text(dokan.seller.notAvailable)):(a("#url-alart").removeClass("text-danger").addClass("text-success"),a("#url-alart-mgs").removeClass("text-danger").addClass("text-success").text(dokan.seller.available))})}),a(".wpuf-form-add #wpuf-map-add-location").attr("name","find_address")})}(jQuery,window);
// source --> https://icarefurnishers.com/wp-content/plugins/wp-user-frontend/assets/vendor/sweetalert2/dist/sweetalert2.js?ver=3.1.17 
/*!
 * sweetalert2 v6.6.4
 * Released under the MIT License.
 */
(function (global, factory) {
	typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
	typeof define === 'function' && define.amd ? define(factory) :
	(global.Sweetalert2 = factory());
}(this, (function () { 'use strict';

var defaultParams = {
  title: '',
  titleText: '',
  text: '',
  html: '',
  type: null,
  customClass: '',
  target: 'body',
  animation: true,
  allowOutsideClick: true,
  allowEscapeKey: true,
  allowEnterKey: true,
  showConfirmButton: true,
  showCancelButton: false,
  preConfirm: null,
  confirmButtonText: 'OK',
  confirmButtonColor: '#3085d6',
  confirmButtonClass: null,
  cancelButtonText: 'Cancel',
  cancelButtonColor: '#aaa',
  cancelButtonClass: null,
  buttonsStyling: true,
  reverseButtons: false,
  focusCancel: false,
  showCloseButton: false,
  showLoaderOnConfirm: false,
  imageUrl: null,
  imageWidth: null,
  imageHeight: null,
  imageClass: null,
  timer: null,
  width: 500,
  padding: 20,
  background: '#fff',
  input: null,
  inputPlaceholder: '',
  inputValue: '',
  inputOptions: {},
  inputAutoTrim: true,
  inputClass: null,
  inputAttributes: {},
  inputValidator: null,
  progressSteps: [],
  currentProgressStep: null,
  progressStepsDistance: '40px',
  onOpen: null,
  onClose: null,
  useRejections: true
};

var swalPrefix = 'swal2-';

var prefix = function prefix(items) {
  var result = {};
  for (var i in items) {
    result[items[i]] = swalPrefix + items[i];
  }
  return result;
};

var swalClasses = prefix(['container', 'shown', 'iosfix', 'modal', 'overlay', 'fade', 'show', 'hide', 'noanimation', 'close', 'title', 'content', 'buttonswrapper', 'confirm', 'cancel', 'icon', 'image', 'input', 'file', 'range', 'select', 'radio', 'checkbox', 'textarea', 'inputerror', 'validationerror', 'progresssteps', 'activeprogressstep', 'progresscircle', 'progressline', 'loading', 'styled']);

var iconTypes = prefix(['success', 'warning', 'info', 'question', 'error']);

/*
 * Set hover, active and focus-states for buttons (source: http://www.sitepoint.com/javascript-generate-lighter-darker-color)
 */
var colorLuminance = function colorLuminance(hex, lum) {
  // Validate hex string
  hex = String(hex).replace(/[^0-9a-f]/gi, '');
  if (hex.length < 6) {
    hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
  }
  lum = lum || 0;

  // Convert to decimal and change luminosity
  var rgb = '#';
  for (var i = 0; i < 3; i++) {
    var c = parseInt(hex.substr(i * 2, 2), 16);
    c = Math.round(Math.min(Math.max(0, c + c * lum), 255)).toString(16);
    rgb += ('00' + c).substr(c.length);
  }

  return rgb;
};

var uniqueArray = function uniqueArray(arr) {
  var result = [];
  for (var i in arr) {
    if (result.indexOf(arr[i]) === -1) {
      result.push(arr[i]);
    }
  }
  return result;
};

/* global MouseEvent */

// Remember state in cases where opening and handling a modal will fiddle with it.
var states = {
  previousWindowKeyDown: null,
  previousActiveElement: null,
  previousBodyPadding: null
};

/*
 * Add modal + overlay to DOM
 */
var init = function init(params) {
  if (typeof document === 'undefined') {
    console.error('SweetAlert2 requires document to initialize');
    return;
  }

  var container = document.createElement('div');
  container.className = swalClasses.container;
  container.innerHTML = sweetHTML;

  var targetElement = document.querySelector(params.target);
  if (!targetElement) {
    console.warn('SweetAlert2: Can\'t find the target "' + params.target + '"');
    targetElement = document.body;
  }
  targetElement.appendChild(container);

  var modal = getModal();
  var input = getChildByClass(modal, swalClasses.input);
  var file = getChildByClass(modal, swalClasses.file);
  var range = modal.querySelector('.' + swalClasses.range + ' input');
  var rangeOutput = modal.querySelector('.' + swalClasses.range + ' output');
  var select = getChildByClass(modal, swalClasses.select);
  var checkbox = modal.querySelector('.' + swalClasses.checkbox + ' input');
  var textarea = getChildByClass(modal, swalClasses.textarea);

  input.oninput = function () {
    sweetAlert.resetValidationError();
  };

  input.onkeydown = function (event) {
    setTimeout(function () {
      if (event.keyCode === 13 && params.allowEnterKey) {
        event.stopPropagation();
        sweetAlert.clickConfirm();
      }
    }, 0);
  };

  file.onchange = function () {
    sweetAlert.resetValidationError();
  };

  range.oninput = function () {
    sweetAlert.resetValidationError();
    rangeOutput.value = range.value;
  };

  range.onchange = function () {
    sweetAlert.resetValidationError();
    range.previousSibling.value = range.value;
  };

  select.onchange = function () {
    sweetAlert.resetValidationError();
  };

  checkbox.onchange = function () {
    sweetAlert.resetValidationError();
  };

  textarea.oninput = function () {
    sweetAlert.resetValidationError();
  };

  return modal;
};

/*
 * Manipulate DOM
 */

var sweetHTML = ('\n <div role="dialog" aria-labelledby="' + swalClasses.title + '" aria-describedby="' + swalClasses.content + '" class="' + swalClasses.modal + '" tabindex="-1">\n   <ul class="' + swalClasses.progresssteps + '"></ul>\n   <div class="' + swalClasses.icon + ' ' + iconTypes.error + '">\n     <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span>\n   </div>\n   <div class="' + swalClasses.icon + ' ' + iconTypes.question + '">?</div>\n   <div class="' + swalClasses.icon + ' ' + iconTypes.warning + '">!</div>\n   <div class="' + swalClasses.icon + ' ' + iconTypes.info + '">i</div>\n   <div class="' + swalClasses.icon + ' ' + iconTypes.success + '">\n     <div class="swal2-success-circular-line-left"></div>\n     <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>\n     <div class="swal2-success-ring"></div> <div class="swal2-success-fix"></div>\n     <div class="swal2-success-circular-line-right"></div>\n   </div>\n   <img class="' + swalClasses.image + '">\n   <h2 class="' + swalClasses.title + '" id="' + swalClasses.title + '"></h2>\n   <div id="' + swalClasses.content + '" class="' + swalClasses.content + '"></div>\n   <input class="' + swalClasses.input + '">\n   <input type="file" class="' + swalClasses.file + '">\n   <div class="' + swalClasses.range + '">\n     <output></output>\n     <input type="range">\n   </div>\n   <select class="' + swalClasses.select + '"></select>\n   <div class="' + swalClasses.radio + '"></div>\n   <label for="' + swalClasses.checkbox + '" class="' + swalClasses.checkbox + '">\n     <input type="checkbox">\n   </label>\n   <textarea class="' + swalClasses.textarea + '"></textarea>\n   <div class="' + swalClasses.validationerror + '"></div>\n   <div class="' + swalClasses.buttonswrapper + '">\n     <button type="button" class="' + swalClasses.confirm + '">OK</button>\n     <button type="button" class="' + swalClasses.cancel + '">Cancel</button>\n   </div>\n   <button type="button" class="' + swalClasses.close + '" aria-label="Close this dialog">&times;</button>\n </div>\n').replace(/(^|\n)\s*/g, '');

var getContainer = function getContainer() {
  return document.body.querySelector('.' + swalClasses.container);
};

var getModal = function getModal() {
  return getContainer() ? getContainer().querySelector('.' + swalClasses.modal) : null;
};

var getIcons = function getIcons() {
  var modal = getModal();
  return modal.querySelectorAll('.' + swalClasses.icon);
};

var elementByClass = function elementByClass(className) {
  return getContainer() ? getContainer().querySelector('.' + className) : null;
};

var getTitle = function getTitle() {
  return elementByClass(swalClasses.title);
};

var getContent = function getContent() {
  return elementByClass(swalClasses.content);
};

var getImage = function getImage() {
  return elementByClass(swalClasses.image);
};

var getButtonsWrapper = function getButtonsWrapper() {
  return elementByClass(swalClasses.buttonswrapper);
};

var getProgressSteps = function getProgressSteps() {
  return elementByClass(swalClasses.progresssteps);
};

var getValidationError = function getValidationError() {
  return elementByClass(swalClasses.validationerror);
};

var getConfirmButton = function getConfirmButton() {
  return elementByClass(swalClasses.confirm);
};

var getCancelButton = function getCancelButton() {
  return elementByClass(swalClasses.cancel);
};

var getCloseButton = function getCloseButton() {
  return elementByClass(swalClasses.close);
};

var getFocusableElements = function getFocusableElements(focusCancel) {
  var buttons = [getConfirmButton(), getCancelButton()];
  if (focusCancel) {
    buttons.reverse();
  }
  var focusableElements = buttons.concat(Array.prototype.slice.call(getModal().querySelectorAll('button, input:not([type=hidden]), textarea, select, a, *[tabindex]:not([tabindex="-1"])')));
  return uniqueArray(focusableElements);
};

var hasClass = function hasClass(elem, className) {
  if (elem.classList) {
    return elem.classList.contains(className);
  }
  return false;
};

var focusInput = function focusInput(input) {
  input.focus();

  // place cursor at end of text in text input
  if (input.type !== 'file') {
    // http://stackoverflow.com/a/2345915/1331425
    var val = input.value;
    input.value = '';
    input.value = val;
  }
};

var addClass = function addClass(elem, className) {
  if (!elem || !className) {
    return;
  }
  var classes = className.split(/\s+/).filter(Boolean);
  classes.forEach(function (className) {
    elem.classList.add(className);
  });
};

var removeClass = function removeClass(elem, className) {
  if (!elem || !className) {
    return;
  }
  var classes = className.split(/\s+/).filter(Boolean);
  classes.forEach(function (className) {
    elem.classList.remove(className);
  });
};

var getChildByClass = function getChildByClass(elem, className) {
  for (var i = 0; i < elem.childNodes.length; i++) {
    if (hasClass(elem.childNodes[i], className)) {
      return elem.childNodes[i];
    }
  }
};

var show = function show(elem, display) {
  if (!display) {
    display = 'block';
  }
  elem.style.opacity = '';
  elem.style.display = display;
};

var hide = function hide(elem) {
  elem.style.opacity = '';
  elem.style.display = 'none';
};

var empty = function empty(elem) {
  while (elem.firstChild) {
    elem.removeChild(elem.firstChild);
  }
};

// borrowed from jqeury $(elem).is(':visible') implementation
var isVisible = function isVisible(elem) {
  return elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length;
};

var removeStyleProperty = function removeStyleProperty(elem, property) {
  if (elem.style.removeProperty) {
    elem.style.removeProperty(property);
  } else {
    elem.style.removeAttribute(property);
  }
};

var fireClick = function fireClick(node) {
  if (!isVisible(node)) {
    return false;
  }

  // Taken from http://www.nonobtrusive.com/2011/11/29/programatically-fire-crossbrowser-click-event-with-javascript/
  // Then fixed for today's Chrome browser.
  if (typeof MouseEvent === 'function') {
    // Up-to-date approach
    var mevt = new MouseEvent('click', {
      view: window,
      bubbles: false,
      cancelable: true
    });
    node.dispatchEvent(mevt);
  } else if (document.createEvent) {
    // Fallback
    var evt = document.createEvent('MouseEvents');
    evt.initEvent('click', false, false);
    node.dispatchEvent(evt);
  } else if (document.createEventObject) {
    node.fireEvent('onclick');
  } else if (typeof node.onclick === 'function') {
    node.onclick();
  }
};

var animationEndEvent = function () {
  var testEl = document.createElement('div');
  var transEndEventNames = {
    'WebkitAnimation': 'webkitAnimationEnd',
    'OAnimation': 'oAnimationEnd oanimationend',
    'msAnimation': 'MSAnimationEnd',
    'animation': 'animationend'
  };
  for (var i in transEndEventNames) {
    if (transEndEventNames.hasOwnProperty(i) && testEl.style[i] !== undefined) {
      return transEndEventNames[i];
    }
  }

  return false;
}();

// Reset previous window keydown handler and focued element
var resetPrevState = function resetPrevState() {
  window.onkeydown = states.previousWindowKeyDown;
  if (states.previousActiveElement && states.previousActiveElement.focus) {
    var x = window.scrollX;
    var y = window.scrollY;
    states.previousActiveElement.focus();
    if (x && y) {
      // IE has no scrollX/scrollY support
      window.scrollTo(x, y);
    }
  }
};

// Measure width of scrollbar
// https://github.com/twbs/bootstrap/blob/master/js/modal.js#L279-L286
var measureScrollbar = function measureScrollbar() {
  var supportsTouch = 'ontouchstart' in window || navigator.msMaxTouchPoints;
  if (supportsTouch) {
    return 0;
  }
  var scrollDiv = document.createElement('div');
  scrollDiv.style.width = '50px';
  scrollDiv.style.height = '50px';
  scrollDiv.style.overflow = 'scroll';
  document.body.appendChild(scrollDiv);
  var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
  document.body.removeChild(scrollDiv);
  return scrollbarWidth;
};

// JavaScript Debounce Function
// Simplivied version of https://davidwalsh.name/javascript-debounce-function
var debounce = function debounce(func, wait) {
  var timeout = void 0;
  return function () {
    var later = function later() {
      timeout = null;
      func();
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
};

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) {
  return typeof obj;
} : function (obj) {
  return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
};





















var _extends = Object.assign || function (target) {
  for (var i = 1; i < arguments.length; i++) {
    var source = arguments[i];

    for (var key in source) {
      if (Object.prototype.hasOwnProperty.call(source, key)) {
        target[key] = source[key];
      }
    }
  }

  return target;
};

var modalParams = _extends({}, defaultParams);
var queue = [];
var swal2Observer = void 0;

/*
 * Set type, text and actions on modal
 */
var setParameters = function setParameters(params) {
  var modal = getModal() || init(params);

  for (var param in params) {
    if (!defaultParams.hasOwnProperty(param) && param !== 'extraParams') {
      console.warn('SweetAlert2: Unknown parameter "' + param + '"');
    }
  }

  // Set modal width
  modal.style.width = typeof params.width === 'number' ? params.width + 'px' : params.width;

  modal.style.padding = params.padding + 'px';
  modal.style.background = params.background;
  var successIconParts = modal.querySelectorAll('[class^=swal2-success-circular-line], .swal2-success-fix');
  for (var i = 0; i < successIconParts.length; i++) {
    successIconParts[i].style.background = params.background;
  }

  var title = getTitle();
  var content = getContent();
  var buttonsWrapper = getButtonsWrapper();
  var confirmButton = getConfirmButton();
  var cancelButton = getCancelButton();
  var closeButton = getCloseButton();

  // Title
  if (params.titleText) {
    title.innerText = params.titleText;
  } else {
    title.innerHTML = params.title.split('\n').join('<br>');
  }

  // Content
  if (params.text || params.html) {
    if (_typeof(params.html) === 'object') {
      content.innerHTML = '';
      if (0 in params.html) {
        for (var _i = 0; _i in params.html; _i++) {
          content.appendChild(params.html[_i].cloneNode(true));
        }
      } else {
        content.appendChild(params.html.cloneNode(true));
      }
    } else if (params.html) {
      content.innerHTML = params.html;
    } else if (params.text) {
      content.textContent = params.text;
    }
    show(content);
  } else {
    hide(content);
  }

  // Close button
  if (params.showCloseButton) {
    show(closeButton);
  } else {
    hide(closeButton);
  }

  // Custom Class
  modal.className = swalClasses.modal;
  if (params.customClass) {
    addClass(modal, params.customClass);
  }

  // Progress steps
  var progressStepsContainer = getProgressSteps();
  var currentProgressStep = parseInt(params.currentProgressStep === null ? sweetAlert.getQueueStep() : params.currentProgressStep, 10);
  if (params.progressSteps.length) {
    show(progressStepsContainer);
    empty(progressStepsContainer);
    if (currentProgressStep >= params.progressSteps.length) {
      console.warn('SweetAlert2: Invalid currentProgressStep parameter, it should be less than progressSteps.length ' + '(currentProgressStep like JS arrays starts from 0)');
    }
    params.progressSteps.forEach(function (step, index) {
      var circle = document.createElement('li');
      addClass(circle, swalClasses.progresscircle);
      circle.innerHTML = step;
      if (index === currentProgressStep) {
        addClass(circle, swalClasses.activeprogressstep);
      }
      progressStepsContainer.appendChild(circle);
      if (index !== params.progressSteps.length - 1) {
        var line = document.createElement('li');
        addClass(line, swalClasses.progressline);
        line.style.width = params.progressStepsDistance;
        progressStepsContainer.appendChild(line);
      }
    });
  } else {
    hide(progressStepsContainer);
  }

  // Icon
  var icons = getIcons();
  for (var _i2 = 0; _i2 < icons.length; _i2++) {
    hide(icons[_i2]);
  }
  if (params.type) {
    var validType = false;
    for (var iconType in iconTypes) {
      if (params.type === iconType) {
        validType = true;
        break;
      }
    }
    if (!validType) {
      console.error('SweetAlert2: Unknown alert type: ' + params.type);
      return false;
    }
    var icon = modal.querySelector('.' + swalClasses.icon + '.' + iconTypes[params.type]);
    show(icon);

    // Animate icon
    if (params.animation) {
      switch (params.type) {
        case 'success':
          addClass(icon, 'swal2-animate-success-icon');
          addClass(icon.querySelector('.swal2-success-line-tip'), 'swal2-animate-success-line-tip');
          addClass(icon.querySelector('.swal2-success-line-long'), 'swal2-animate-success-line-long');
          break;
        case 'error':
          addClass(icon, 'swal2-animate-error-icon');
          addClass(icon.querySelector('.swal2-x-mark'), 'swal2-animate-x-mark');
          break;
        default:
          break;
      }
    }
  }

  // Custom image
  var image = getImage();
  if (params.imageUrl) {
    image.setAttribute('src', params.imageUrl);
    show(image);

    if (params.imageWidth) {
      image.setAttribute('width', params.imageWidth);
    } else {
      image.removeAttribute('width');
    }

    if (params.imageHeight) {
      image.setAttribute('height', params.imageHeight);
    } else {
      image.removeAttribute('height');
    }

    image.className = swalClasses.image;
    if (params.imageClass) {
      addClass(image, params.imageClass);
    }
  } else {
    hide(image);
  }

  // Cancel button
  if (params.showCancelButton) {
    cancelButton.style.display = 'inline-block';
  } else {
    hide(cancelButton);
  }

  // Confirm button
  if (params.showConfirmButton) {
    removeStyleProperty(confirmButton, 'display');
  } else {
    hide(confirmButton);
  }

  // Buttons wrapper
  if (!params.showConfirmButton && !params.showCancelButton) {
    hide(buttonsWrapper);
  } else {
    show(buttonsWrapper);
  }

  // Edit text on cancel and confirm buttons
  confirmButton.innerHTML = params.confirmButtonText;
  cancelButton.innerHTML = params.cancelButtonText;

  // Set buttons to selected background colors
  if (params.buttonsStyling) {
    confirmButton.style.backgroundColor = params.confirmButtonColor;
    cancelButton.style.backgroundColor = params.cancelButtonColor;
  }

  // Add buttons custom classes
  confirmButton.className = swalClasses.confirm;
  addClass(confirmButton, params.confirmButtonClass);
  cancelButton.className = swalClasses.cancel;
  addClass(cancelButton, params.cancelButtonClass);

  // Buttons styling
  if (params.buttonsStyling) {
    addClass(confirmButton, swalClasses.styled);
    addClass(cancelButton, swalClasses.styled);
  } else {
    removeClass(confirmButton, swalClasses.styled);
    removeClass(cancelButton, swalClasses.styled);

    confirmButton.style.backgroundColor = confirmButton.style.borderLeftColor = confirmButton.style.borderRightColor = '';
    cancelButton.style.backgroundColor = cancelButton.style.borderLeftColor = cancelButton.style.borderRightColor = '';
  }

  // CSS animation
  if (params.animation === true) {
    removeClass(modal, swalClasses.noanimation);
  } else {
    addClass(modal, swalClasses.noanimation);
  }
};

/*
 * Animations
 */
var openModal = function openModal(animation, onComplete) {
  var container = getContainer();
  var modal = getModal();

  if (animation) {
    addClass(modal, swalClasses.show);
    addClass(container, swalClasses.fade);
    removeClass(modal, swalClasses.hide);
  } else {
    removeClass(modal, swalClasses.fade);
  }
  show(modal);

  // scrolling is 'hidden' until animation is done, after that 'auto'
  container.style.overflowY = 'hidden';
  if (animationEndEvent && !hasClass(modal, swalClasses.noanimation)) {
    modal.addEventListener(animationEndEvent, function swalCloseEventFinished() {
      modal.removeEventListener(animationEndEvent, swalCloseEventFinished);
      container.style.overflowY = 'auto';
    });
  } else {
    container.style.overflowY = 'auto';
  }

  addClass(document.documentElement, swalClasses.shown);
  addClass(document.body, swalClasses.shown);
  addClass(container, swalClasses.shown);
  fixScrollbar();
  iOSfix();
  states.previousActiveElement = document.activeElement;
  if (onComplete !== null && typeof onComplete === 'function') {
    setTimeout(function () {
      onComplete(modal);
    });
  }
};

var fixScrollbar = function fixScrollbar() {
  // for queues, do not do this more than once
  if (states.previousBodyPadding !== null) {
    return;
  }
  // if the body has overflow
  if (document.body.scrollHeight > window.innerHeight) {
    // add padding so the content doesn't shift after removal of scrollbar
    states.previousBodyPadding = document.body.style.paddingRight;
    document.body.style.paddingRight = measureScrollbar() + 'px';
  }
};

var undoScrollbar = function undoScrollbar() {
  if (states.previousBodyPadding !== null) {
    document.body.style.paddingRight = states.previousBodyPadding;
    states.previousBodyPadding = null;
  }
};

// Fix iOS scrolling http://stackoverflow.com/q/39626302/1331425
var iOSfix = function iOSfix() {
  var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
  if (iOS && !hasClass(document.body, swalClasses.iosfix)) {
    var offset = document.body.scrollTop;
    document.body.style.top = offset * -1 + 'px';
    addClass(document.body, swalClasses.iosfix);
  }
};

var undoIOSfix = function undoIOSfix() {
  if (hasClass(document.body, swalClasses.iosfix)) {
    var offset = parseInt(document.body.style.top, 10);
    removeClass(document.body, swalClasses.iosfix);
    document.body.style.top = '';
    document.body.scrollTop = offset * -1;
  }
};

// SweetAlert entry point
var sweetAlert = function sweetAlert() {
  for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
    args[_key] = arguments[_key];
  }

  if (args[0] === undefined) {
    console.error('SweetAlert2 expects at least 1 attribute!');
    return false;
  }

  var params = _extends({}, modalParams);

  switch (_typeof(args[0])) {
    case 'string':
      params.title = args[0];
      params.html = args[1];
      params.type = args[2];

      break;

    case 'object':
      _extends(params, args[0]);
      params.extraParams = args[0].extraParams;

      if (params.input === 'email' && params.inputValidator === null) {
        params.inputValidator = function (email) {
          return new Promise(function (resolve, reject) {
            var emailRegex = /^[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (emailRegex.test(email)) {
              resolve();
            } else {
              reject('Invalid email address');
            }
          });
        };
      }

      if (params.input === 'url' && params.inputValidator === null) {
        params.inputValidator = function (url) {
          return new Promise(function (resolve, reject) {
            var urlRegex = /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([/\w .-]*)*\/?$/;
            if (urlRegex.test(url)) {
              resolve();
            } else {
              reject('Invalid URL');
            }
          });
        };
      }
      break;

    default:
      console.error('SweetAlert2: Unexpected type of argument! Expected "string" or "object", got ' + _typeof(args[0]));
      return false;
  }

  setParameters(params);

  var container = getContainer();
  var modal = getModal();

  return new Promise(function (resolve, reject) {
    // Close on timer
    if (params.timer) {
      modal.timeout = setTimeout(function () {
        sweetAlert.closeModal(params.onClose);
        if (params.useRejections) {
          reject('timer');
        } else {
          resolve({ dismiss: 'timer' });
        }
      }, params.timer);
    }

    // Get input element by specified type or, if type isn't specified, by params.input
    var getInput = function getInput(inputType) {
      inputType = inputType || params.input;
      if (!inputType) {
        return null;
      }
      switch (inputType) {
        case 'select':
        case 'textarea':
        case 'file':
          return getChildByClass(modal, swalClasses[inputType]);
        case 'checkbox':
          return modal.querySelector('.' + swalClasses.checkbox + ' input');
        case 'radio':
          return modal.querySelector('.' + swalClasses.radio + ' input:checked') || modal.querySelector('.' + swalClasses.radio + ' input:first-child');
        case 'range':
          return modal.querySelector('.' + swalClasses.range + ' input');
        default:
          return getChildByClass(modal, swalClasses.input);
      }
    };

    // Get the value of the modal input
    var getInputValue = function getInputValue() {
      var input = getInput();
      if (!input) {
        return null;
      }
      switch (params.input) {
        case 'checkbox':
          return input.checked ? 1 : 0;
        case 'radio':
          return input.checked ? input.value : null;
        case 'file':
          return input.files.length ? input.files[0] : null;
        default:
          return params.inputAutoTrim ? input.value.trim() : input.value;
      }
    };

    // input autofocus
    if (params.input) {
      setTimeout(function () {
        var input = getInput();
        if (input) {
          focusInput(input);
        }
      }, 0);
    }

    var confirm = function confirm(value) {
      if (params.showLoaderOnConfirm) {
        sweetAlert.showLoading();
      }

      if (params.preConfirm) {
        params.preConfirm(value, params.extraParams).then(function (preConfirmValue) {
          sweetAlert.closeModal(params.onClose);
          resolve(preConfirmValue || value);
        }, function (error) {
          sweetAlert.hideLoading();
          if (error) {
            sweetAlert.showValidationError(error);
          }
        });
      } else {
        sweetAlert.closeModal(params.onClose);
        if (params.useRejections) {
          resolve(value);
        } else {
          resolve({ value: value });
        }
      }
    };

    // Mouse interactions
    var onButtonEvent = function onButtonEvent(event) {
      var e = event || window.event;
      var target = e.target || e.srcElement;
      var confirmButton = getConfirmButton();
      var cancelButton = getCancelButton();
      var targetedConfirm = confirmButton && (confirmButton === target || confirmButton.contains(target));
      var targetedCancel = cancelButton && (cancelButton === target || cancelButton.contains(target));

      switch (e.type) {
        case 'mouseover':
        case 'mouseup':
          if (params.buttonsStyling) {
            if (targetedConfirm) {
              confirmButton.style.backgroundColor = colorLuminance(params.confirmButtonColor, -0.1);
            } else if (targetedCancel) {
              cancelButton.style.backgroundColor = colorLuminance(params.cancelButtonColor, -0.1);
            }
          }
          break;
        case 'mouseout':
          if (params.buttonsStyling) {
            if (targetedConfirm) {
              confirmButton.style.backgroundColor = params.confirmButtonColor;
            } else if (targetedCancel) {
              cancelButton.style.backgroundColor = params.cancelButtonColor;
            }
          }
          break;
        case 'mousedown':
          if (params.buttonsStyling) {
            if (targetedConfirm) {
              confirmButton.style.backgroundColor = colorLuminance(params.confirmButtonColor, -0.2);
            } else if (targetedCancel) {
              cancelButton.style.backgroundColor = colorLuminance(params.cancelButtonColor, -0.2);
            }
          }
          break;
        case 'click':
          // Clicked 'confirm'
          if (targetedConfirm && sweetAlert.isVisible()) {
            sweetAlert.disableButtons();
            if (params.input) {
              var inputValue = getInputValue();

              if (params.inputValidator) {
                sweetAlert.disableInput();
                params.inputValidator(inputValue, params.extraParams).then(function () {
                  sweetAlert.enableButtons();
                  sweetAlert.enableInput();
                  confirm(inputValue);
                }, function (error) {
                  sweetAlert.enableButtons();
                  sweetAlert.enableInput();
                  if (error) {
                    sweetAlert.showValidationError(error);
                  }
                });
              } else {
                confirm(inputValue);
              }
            } else {
              confirm(true);
            }

            // Clicked 'cancel'
          } else if (targetedCancel && sweetAlert.isVisible()) {
            sweetAlert.disableButtons();
            sweetAlert.closeModal(params.onClose);
            if (params.useRejections) {
              reject('cancel');
            } else {
              resolve({ dismiss: 'cancel' });
            }
          }
          break;
        default:
      }
    };

    var buttons = modal.querySelectorAll('button');
    for (var i = 0; i < buttons.length; i++) {
      buttons[i].onclick = onButtonEvent;
      buttons[i].onmouseover = onButtonEvent;
      buttons[i].onmouseout = onButtonEvent;
      buttons[i].onmousedown = onButtonEvent;
    }

    // Closing modal by close button
    getCloseButton().onclick = function () {
      sweetAlert.closeModal(params.onClose);
      if (params.useRejections) {
        reject('close');
      } else {
        resolve({ dismiss: 'close' });
      }
    };

    // Closing modal by overlay click
    container.onclick = function (e) {
      if (e.target !== container) {
        return;
      }
      if (params.allowOutsideClick) {
        sweetAlert.closeModal(params.onClose);
        if (params.useRejections) {
          reject('overlay');
        } else {
          resolve({ dismiss: 'overlay' });
        }
      }
    };

    var buttonsWrapper = getButtonsWrapper();
    var confirmButton = getConfirmButton();
    var cancelButton = getCancelButton();

    // Reverse buttons (Confirm on the right side)
    if (params.reverseButtons) {
      confirmButton.parentNode.insertBefore(cancelButton, confirmButton);
    } else {
      confirmButton.parentNode.insertBefore(confirmButton, cancelButton);
    }

    // Focus handling
    var setFocus = function setFocus(index, increment) {
      var focusableElements = getFocusableElements(params.focusCancel);
      // search for visible elements and select the next possible match
      for (var _i3 = 0; _i3 < focusableElements.length; _i3++) {
        index = index + increment;

        // rollover to first item
        if (index === focusableElements.length) {
          index = 0;

          // go to last item
        } else if (index === -1) {
          index = focusableElements.length - 1;
        }

        // determine if element is visible
        var el = focusableElements[index];
        if (isVisible(el)) {
          return el.focus();
        }
      }
    };

    var handleKeyDown = function handleKeyDown(event) {
      var e = event || window.event;
      var keyCode = e.keyCode || e.which;

      if ([9, 13, 32, 27, 37, 38, 39, 40].indexOf(keyCode) === -1) {
        // Don't do work on keys we don't care about.
        return;
      }

      var targetElement = e.target || e.srcElement;

      var focusableElements = getFocusableElements(params.focusCancel);
      var btnIndex = -1; // Find the button - note, this is a nodelist, not an array.
      for (var _i4 = 0; _i4 < focusableElements.length; _i4++) {
        if (targetElement === focusableElements[_i4]) {
          btnIndex = _i4;
          break;
        }
      }

      // TAB
      if (keyCode === 9) {
        if (!e.shiftKey) {
          // Cycle to the next button
          setFocus(btnIndex, 1);
        } else {
          // Cycle to the prev button
          setFocus(btnIndex, -1);
        }
        e.stopPropagation();
        e.preventDefault();

        // ARROWS - switch focus between buttons
      } else if (keyCode === 37 || keyCode === 38 || keyCode === 39 || keyCode === 40) {
        // focus Cancel button if Confirm button is currently focused
        if (document.activeElement === confirmButton && isVisible(cancelButton)) {
          cancelButton.focus();
          // and vice versa
        } else if (document.activeElement === cancelButton && isVisible(confirmButton)) {
          confirmButton.focus();
        }

        // ENTER/SPACE
      } else if (keyCode === 13 || keyCode === 32) {
        if (btnIndex === -1 && params.allowEnterKey) {
          // ENTER/SPACE clicked outside of a button.
          if (params.focusCancel) {
            fireClick(cancelButton, e);
          } else {
            fireClick(confirmButton, e);
          }
          e.stopPropagation();
          e.preventDefault();
        }

        // ESC
      } else if (keyCode === 27 && params.allowEscapeKey === true) {
        sweetAlert.closeModal(params.onClose);
        if (params.useRejections) {
          reject('esc');
        } else {
          resolve({ dismiss: 'esc' });
        }
      }
    };

    if (!window.onkeydown || window.onkeydown.toString() !== handleKeyDown.toString()) {
      states.previousWindowKeyDown = window.onkeydown;
      window.onkeydown = handleKeyDown;
    }

    // Loading state
    if (params.buttonsStyling) {
      confirmButton.style.borderLeftColor = params.confirmButtonColor;
      confirmButton.style.borderRightColor = params.confirmButtonColor;
    }

    /**
     * Show spinner instead of Confirm button and disable Cancel button
     */
    sweetAlert.hideLoading = sweetAlert.disableLoading = function () {
      if (!params.showConfirmButton) {
        hide(confirmButton);
        if (!params.showCancelButton) {
          hide(getButtonsWrapper());
        }
      }
      removeClass(buttonsWrapper, swalClasses.loading);
      removeClass(modal, swalClasses.loading);
      confirmButton.disabled = false;
      cancelButton.disabled = false;
    };

    sweetAlert.getTitle = function () {
      return getTitle();
    };
    sweetAlert.getContent = function () {
      return getContent();
    };
    sweetAlert.getInput = function () {
      return getInput();
    };
    sweetAlert.getImage = function () {
      return getImage();
    };
    sweetAlert.getButtonsWrapper = function () {
      return getButtonsWrapper();
    };
    sweetAlert.getConfirmButton = function () {
      return getConfirmButton();
    };
    sweetAlert.getCancelButton = function () {
      return getCancelButton();
    };

    sweetAlert.enableButtons = function () {
      confirmButton.disabled = false;
      cancelButton.disabled = false;
    };

    sweetAlert.disableButtons = function () {
      confirmButton.disabled = true;
      cancelButton.disabled = true;
    };

    sweetAlert.enableConfirmButton = function () {
      confirmButton.disabled = false;
    };

    sweetAlert.disableConfirmButton = function () {
      confirmButton.disabled = true;
    };

    sweetAlert.enableInput = function () {
      var input = getInput();
      if (!input) {
        return false;
      }
      if (input.type === 'radio') {
        var radiosContainer = input.parentNode.parentNode;
        var radios = radiosContainer.querySelectorAll('input');
        for (var _i5 = 0; _i5 < radios.length; _i5++) {
          radios[_i5].disabled = false;
        }
      } else {
        input.disabled = false;
      }
    };

    sweetAlert.disableInput = function () {
      var input = getInput();
      if (!input) {
        return false;
      }
      if (input && input.type === 'radio') {
        var radiosContainer = input.parentNode.parentNode;
        var radios = radiosContainer.querySelectorAll('input');
        for (var _i6 = 0; _i6 < radios.length; _i6++) {
          radios[_i6].disabled = true;
        }
      } else {
        input.disabled = true;
      }
    };

    // Set modal min-height to disable scrolling inside the modal
    sweetAlert.recalculateHeight = debounce(function () {
      var modal = getModal();
      if (!modal) {
        return;
      }
      var prevState = modal.style.display;
      modal.style.minHeight = '';
      show(modal);
      modal.style.minHeight = modal.scrollHeight + 1 + 'px';
      modal.style.display = prevState;
    }, 50);

    // Show block with validation error
    sweetAlert.showValidationError = function (error) {
      var validationError = getValidationError();
      validationError.innerHTML = error;
      show(validationError);

      var input = getInput();
      if (input) {
        focusInput(input);
        addClass(input, swalClasses.inputerror);
      }
    };

    // Hide block with validation error
    sweetAlert.resetValidationError = function () {
      var validationError = getValidationError();
      hide(validationError);
      sweetAlert.recalculateHeight();

      var input = getInput();
      if (input) {
        removeClass(input, swalClasses.inputerror);
      }
    };

    sweetAlert.getProgressSteps = function () {
      return params.progressSteps;
    };

    sweetAlert.setProgressSteps = function (progressSteps) {
      params.progressSteps = progressSteps;
      setParameters(params);
    };

    sweetAlert.showProgressSteps = function () {
      show(getProgressSteps());
    };

    sweetAlert.hideProgressSteps = function () {
      hide(getProgressSteps());
    };

    sweetAlert.enableButtons();
    sweetAlert.hideLoading();
    sweetAlert.resetValidationError();

    // inputs
    var inputTypes = ['input', 'file', 'range', 'select', 'radio', 'checkbox', 'textarea'];
    var input = void 0;
    for (var _i7 = 0; _i7 < inputTypes.length; _i7++) {
      var inputClass = swalClasses[inputTypes[_i7]];
      var inputContainer = getChildByClass(modal, inputClass);
      input = getInput(inputTypes[_i7]);

      // set attributes
      if (input) {
        for (var j in input.attributes) {
          if (input.attributes.hasOwnProperty(j)) {
            var attrName = input.attributes[j].name;
            if (attrName !== 'type' && attrName !== 'value') {
              input.removeAttribute(attrName);
            }
          }
        }
        for (var attr in params.inputAttributes) {
          input.setAttribute(attr, params.inputAttributes[attr]);
        }
      }

      // set class
      inputContainer.className = inputClass;
      if (params.inputClass) {
        addClass(inputContainer, params.inputClass);
      }

      hide(inputContainer);
    }

    var populateInputOptions = void 0;
    switch (params.input) {
      case 'text':
      case 'email':
      case 'password':
      case 'number':
      case 'tel':
      case 'url':
        input = getChildByClass(modal, swalClasses.input);
        input.value = params.inputValue;
        input.placeholder = params.inputPlaceholder;
        input.type = params.input;
        show(input);
        break;
      case 'file':
        input = getChildByClass(modal, swalClasses.file);
        input.placeholder = params.inputPlaceholder;
        input.type = params.input;
        show(input);
        break;
      case 'range':
        var range = getChildByClass(modal, swalClasses.range);
        var rangeInput = range.querySelector('input');
        var rangeOutput = range.querySelector('output');
        rangeInput.value = params.inputValue;
        rangeInput.type = params.input;
        rangeOutput.value = params.inputValue;
        show(range);
        break;
      case 'select':
        var select = getChildByClass(modal, swalClasses.select);
        select.innerHTML = '';
        if (params.inputPlaceholder) {
          var placeholder = document.createElement('option');
          placeholder.innerHTML = params.inputPlaceholder;
          placeholder.value = '';
          placeholder.disabled = true;
          placeholder.selected = true;
          select.appendChild(placeholder);
        }
        populateInputOptions = function populateInputOptions(inputOptions) {
          for (var optionValue in inputOptions) {
            var option = document.createElement('option');
            option.value = optionValue;
            option.innerHTML = inputOptions[optionValue];
            if (params.inputValue === optionValue) {
              option.selected = true;
            }
            select.appendChild(option);
          }
          show(select);
          select.focus();
        };
        break;
      case 'radio':
        var radio = getChildByClass(modal, swalClasses.radio);
        radio.innerHTML = '';
        populateInputOptions = function populateInputOptions(inputOptions) {
          for (var radioValue in inputOptions) {
            var radioInput = document.createElement('input');
            var radioLabel = document.createElement('label');
            var radioLabelSpan = document.createElement('span');
            radioInput.type = 'radio';
            radioInput.name = swalClasses.radio;
            radioInput.value = radioValue;
            if (params.inputValue === radioValue) {
              radioInput.checked = true;
            }
            radioLabelSpan.innerHTML = inputOptions[radioValue];
            radioLabel.appendChild(radioInput);
            radioLabel.appendChild(radioLabelSpan);
            radioLabel.for = radioInput.id;
            radio.appendChild(radioLabel);
          }
          show(radio);
          var radios = radio.querySelectorAll('input');
          if (radios.length) {
            radios[0].focus();
          }
        };
        break;
      case 'checkbox':
        var checkbox = getChildByClass(modal, swalClasses.checkbox);
        var checkboxInput = getInput('checkbox');
        checkboxInput.type = 'checkbox';
        checkboxInput.value = 1;
        checkboxInput.id = swalClasses.checkbox;
        checkboxInput.checked = Boolean(params.inputValue);
        var label = checkbox.getElementsByTagName('span');
        if (label.length) {
          checkbox.removeChild(label[0]);
        }
        label = document.createElement('span');
        label.innerHTML = params.inputPlaceholder;
        checkbox.appendChild(label);
        show(checkbox);
        break;
      case 'textarea':
        var textarea = getChildByClass(modal, swalClasses.textarea);
        textarea.value = params.inputValue;
        textarea.placeholder = params.inputPlaceholder;
        show(textarea);
        break;
      case null:
        break;
      default:
        console.error('SweetAlert2: Unexpected type of input! Expected "text", "email", "password", "number", "tel", "select", "radio", "checkbox", "textarea", "file" or "url", got "' + params.input + '"');
        break;
    }

    if (params.input === 'select' || params.input === 'radio') {
      if (params.inputOptions instanceof Promise) {
        sweetAlert.showLoading();
        params.inputOptions.then(function (inputOptions) {
          sweetAlert.hideLoading();
          populateInputOptions(inputOptions);
        });
      } else if (_typeof(params.inputOptions) === 'object') {
        populateInputOptions(params.inputOptions);
      } else {
        console.error('SweetAlert2: Unexpected type of inputOptions! Expected object or Promise, got ' + _typeof(params.inputOptions));
      }
    }

    openModal(params.animation, params.onOpen);

    // Focus the first element (input or button)
    if (params.allowEnterKey) {
      setFocus(-1, 1);
    } else {
      if (document.activeElement) {
        document.activeElement.blur();
      }
    }

    // fix scroll
    getContainer().scrollTop = 0;

    // Observe changes inside the modal and adjust height
    if (typeof MutationObserver !== 'undefined' && !swal2Observer) {
      swal2Observer = new MutationObserver(sweetAlert.recalculateHeight);
      swal2Observer.observe(modal, { childList: true, characterData: true, subtree: true });
    }
  });
};

/*
 * Global function to determine if swal2 modal is shown
 */
sweetAlert.isVisible = function () {
  return !!getModal();
};

/*
 * Global function for chaining sweetAlert modals
 */
sweetAlert.queue = function (steps) {
  queue = steps;
  var resetQueue = function resetQueue() {
    queue = [];
    document.body.removeAttribute('data-swal2-queue-step');
  };
  var queueResult = [];
  return new Promise(function (resolve, reject) {
    (function step(i, callback) {
      if (i < queue.length) {
        document.body.setAttribute('data-swal2-queue-step', i);

        sweetAlert(queue[i]).then(function (result) {
          queueResult.push(result);
          step(i + 1, callback);
        }, function (dismiss) {
          resetQueue();
          reject(dismiss);
        });
      } else {
        resetQueue();
        resolve(queueResult);
      }
    })(0);
  });
};

/*
 * Global function for getting the index of current modal in queue
 */
sweetAlert.getQueueStep = function () {
  return document.body.getAttribute('data-swal2-queue-step');
};

/*
 * Global function for inserting a modal to the queue
 */
sweetAlert.insertQueueStep = function (step, index) {
  if (index && index < queue.length) {
    return queue.splice(index, 0, step);
  }
  return queue.push(step);
};

/*
 * Global function for deleting a modal from the queue
 */
sweetAlert.deleteQueueStep = function (index) {
  if (typeof queue[index] !== 'undefined') {
    queue.splice(index, 1);
  }
};

/*
 * Global function to close sweetAlert
 */
sweetAlert.close = sweetAlert.closeModal = function (onComplete) {
  var container = getContainer();
  var modal = getModal();
  if (!modal) {
    return;
  }
  removeClass(modal, swalClasses.show);
  addClass(modal, swalClasses.hide);
  clearTimeout(modal.timeout);

  resetPrevState();

  var removeModalAndResetState = function removeModalAndResetState() {
    if (container.parentNode) {
      container.parentNode.removeChild(container);
    }
    removeClass(document.documentElement, swalClasses.shown);
    removeClass(document.body, swalClasses.shown);
    undoScrollbar();
    undoIOSfix();
  };

  // If animation is supported, animate
  if (animationEndEvent && !hasClass(modal, swalClasses.noanimation)) {
    modal.addEventListener(animationEndEvent, function swalCloseEventFinished() {
      modal.removeEventListener(animationEndEvent, swalCloseEventFinished);
      if (hasClass(modal, swalClasses.hide)) {
        removeModalAndResetState();
      }
    });
  } else {
    // Otherwise, remove immediately
    removeModalAndResetState();
  }
  if (onComplete !== null && typeof onComplete === 'function') {
    setTimeout(function () {
      onComplete(modal);
    });
  }
};

/*
 * Global function to click 'Confirm' button
 */
sweetAlert.clickConfirm = function () {
  return getConfirmButton().click();
};

/*
 * Global function to click 'Cancel' button
 */
sweetAlert.clickCancel = function () {
  return getCancelButton().click();
};

/**
 * Show spinner instead of Confirm button and disable Cancel button
 */
sweetAlert.showLoading = sweetAlert.enableLoading = function () {
  var modal = getModal();
  if (!modal) {
    sweetAlert('');
  }
  var buttonsWrapper = getButtonsWrapper();
  var confirmButton = getConfirmButton();
  var cancelButton = getCancelButton();

  show(buttonsWrapper);
  show(confirmButton, 'inline-block');
  addClass(buttonsWrapper, swalClasses.loading);
  addClass(modal, swalClasses.loading);
  confirmButton.disabled = true;
  cancelButton.disabled = true;
};

/**
 * Set default params for each popup
 * @param {Object} userParams
 */
sweetAlert.setDefaults = function (userParams) {
  if (!userParams || (typeof userParams === 'undefined' ? 'undefined' : _typeof(userParams)) !== 'object') {
    return console.error('SweetAlert2: the argument for setDefaults() is required and has to be a object');
  }

  for (var param in userParams) {
    if (!defaultParams.hasOwnProperty(param) && param !== 'extraParams') {
      console.warn('SweetAlert2: Unknown parameter "' + param + '"');
      delete userParams[param];
    }
  }

  _extends(modalParams, userParams);
};

/**
 * Reset default params for each popup
 */
sweetAlert.resetDefaults = function () {
  modalParams = _extends({}, defaultParams);
};

sweetAlert.noop = function () {};

sweetAlert.version = '6.6.4';

sweetAlert.default = sweetAlert;

return sweetAlert;

})));
if (window.Sweetalert2) window.sweetAlert = window.swal = window.Sweetalert2;