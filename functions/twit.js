//Edit the counter/limiter value as your wish
var count = "104";   //Example: var count = "175";
function limiter(){
var tex = document.myform.comment.value;
var len = tex.length;
if(len > count){
        tex = tex.substring(0,count);
        document.myform.comment.value =tex;
        return false;
}
document.myform.limit.value = count-len;
}