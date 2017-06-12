function topBar(message) {
    $("<div />", { class: 'topbar', text: message }).hide().prependTo("body")
      .slideDown('fast').delay(10000).slideUp(function() { $(this).remove(); });
}
var i = 0;
$("button").click(function() {
    topBar("Test Message " + i++);
});
​