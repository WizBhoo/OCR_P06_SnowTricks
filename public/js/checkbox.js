$(".form-check-input").attr("onchange", "cbChange(this)");
function cbChange(obj) {
    let instate=(obj.checked);
    let cbs = document.getElementsByClassName("form-check-input");
    for (let i = 0; i < cbs.length; i++) {
        cbs[i].checked = false;
    }
    if(instate)obj.checked = true;
}
