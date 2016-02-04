var counter = 1;
var isNameSet = false;
var name = '';
$(document).ready(function () {

    if (isNameSet)
    {
        var id = '#app-' + name + 's';
        $("#addRow").click(function () {
            counter++;
            var appendValue = "<div class='app-spacer'></div>";
            appendValue = appendValue + "<div class='app-label' id='" + name + counter + "Label'>" + counter + ".</div>";
            appendValue = appendValue + "<div class='app-value' id='" + name + counter + "Value'><input type='text' name='" + name + counter + "' required></div>";
            appendValue = appendValue + "<input type='button' class='app-remove' id='" + name + counter + "Remove' value='Remove' />";
            $(id).append(appendValue);
        });
    }
});

function setName(nameToUse)
{
    name = nameToUse;
    isNameSet = true;
}
