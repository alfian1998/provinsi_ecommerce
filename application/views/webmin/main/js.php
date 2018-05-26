<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("background-font");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" line-right", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " line-right";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>