
/**
 * 上传图片公用
 * url 上传图片的路径
 * type 上传文件的图片 avatar头像  logo 等
 * input回执input框存值  如$('#logo')
 * img_src 回执img用户查看
 */
function uploader(type,input,img_src){
    var oFReader = new FileReader();
    var file = document.getElementById('image1').files[0];
    oFReader.readAsDataURL(file);
    oFReader.onloadend = function(oFRevent){
        var src = oFRevent.target.result;
        $.post('/tool/uploader/uploader_img',{src:src,type:type},function(ret){
            ret = $.parseJSON(ret);
            if(ret.data == 1){
                $(input).attr('value',ret.msg);
                $(img_src).attr('src','/'+ret.msg);
            }else{
                alert('上传失败');
            }
        })
    }
   
}