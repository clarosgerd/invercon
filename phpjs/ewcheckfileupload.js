function ew_CheckFileUpload(t,i){var n="#"+i;if($(n)){$(n+":file").bind("fileuploadsubmit",function(t,i){$("#btnAction").css("direction","ltr");$("#btnAction").attr("data-loading-text",'<i class="fa fa-circle-o-notch fa-spin"></i> Uploading...');$("#btnAction").button("loading")});$(n+":file").bind("fileuploadstop",function(t){var i=$(this);$("#btnAction").button("reset");$('input[type="file"]').each(function(t,n){if(i.attr("id")!==$(this).attr("id")){$(this).on("fileuploadprogress",function(){if($("#btnAction").attr("disabled")===undefined){$("#btnAction").button("loading")}}).on("fileuploadstop",function(t,i){$("#btnAction").button("reset")})}})})}}