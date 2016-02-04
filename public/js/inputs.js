var isNameSet = false;
var name = '';
var counter = 1;
var idToAppend = '';
var isOneSet = false;

$(document).ready(function () {

    if (isNameSet)
    {
        idToAppend = '#app-' + name + 's';
        if (!isOneSet)
        {
            setOne(idToAppend, name);
        }
        $("#addRow").click(function () {
            counter++;
            var appendValue = '';
            if (counter === 2)
            {
                appendValue = appendValue + divForButton(name, counter-1);
            }
            appendValue = appendValue + divForSpacer(name, counter);
            appendValue = appendValue + divForLabel(name, counter);
            appendValue = appendValue + divForValue(name, counter);
            appendValue = appendValue + divForButton(name, counter);
            $(idToAppend).append(appendValue);
        });
    }
    $(document).on('click', '.app-remove', function(){
        var removeId = $(this).attr('id');
        var number = removeId.match(/\d+/);
        removeId = "#" + removeId;
        var labelId = "#" + name + number + "Label";
        var valueId = "#" + name + number + "Value";
        var spacerId = "#" + name + number + "Spacer";
        $(removeId).remove();
        $(labelId).remove();
        $(valueId).remove();
        $(spacerId).remove();
    });

});

function setName(nameToUse)
{
    name = nameToUse;
    isNameSet = true;
}

function setOne(id, nameToUse)
{
    var appendValue = divForLabel(nameToUse, 1);
    appendValue = appendValue + divForValue(nameToUse, 1);
    $(id).append(appendValue);
    isOneSet = true;
}

function divForSpacer(nameToUse, number)
{
    return "<div class='app-spacer' id='" + nameToUse + number + "Spacer'></div>";
}

function divForLabel(nameToUse, number)
{
    return "<div class='app-label' id='"
           + nameToUse + number + "Label'>"
           + counter + ".</div>";
}

function divForValue(nameToUse, number)
{
    return "<div class='app-value' id='"
           + nameToUse + number
           + "Value'><input type='text' name='"
           + nameToUse + number + "' required></div>";
}

function divForButton(nameToUse, number)
{
    return "<input type='button' class='app-remove' id='" 
           + nameToUse + number + "Remove' value='Remove' />";
}