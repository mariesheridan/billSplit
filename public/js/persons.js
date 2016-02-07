var counter = 1;
var idToAppend = '';
var isOneSet = false;
// persons - taken from html

$(document).ready(function () {

    var className = "";
    if (getIsClassSet())
    {
        className = getClassName();
        idToAppend = '#app-' + className + 's';
        if (!isEmpty(persons))
        {
            showPreviousInputs(idToAppend, className, persons);
        }
        else if(!getIsOneSet())
        {
            setOne(idToAppend, className);
        }
        $("#addRow").click(function () {
            counter++;
            appendToDiv(idToAppend, className, counter);
        });
    }
    $(document).on('click', '.app-remove', function(){
        var removeId = $(this).attr('id');
        var number = removeId.match(/\d+/);
        removeId = "#" + removeId;
        var labelId = "#" + className + number + "Label";
        var valueId = "#" + className + number + "Value";
        var spacerId = "#" + className + number + "Spacer";
        $(removeId).remove();
        $(labelId).remove();
        $(valueId).remove();
        $(spacerId).remove();
        var values = getValues('.app-value');
        showPreviousInputs(idToAppend, className, values);
    });

});

function setOne(id, nameToUse)
{
    var appendValue = divForLabel(nameToUse, 1);
    appendValue += divForValue(nameToUse, 1);
    $(id).append(appendValue);
    isOneSet = true;
}

function appendToDiv(divId, nameToUse, number)
{
    var appendValue = '';
    if (number === 2)
    {
        appendValue += divForRemove(nameToUse, number-1);
    }
    if (number > 1)
    {
        appendValue += divForSpacer(nameToUse, number);
    }
    appendValue += divForLabel(nameToUse, number);
    appendValue += divForValue(nameToUse, number);
    if (number > 1)
    {
        appendValue += divForRemove(nameToUse, number);
    }
    $(divId).append(appendValue);
}

function showPreviousInputs(divId, nameToUse, inputs)
{
    console.log(inputs);
    $(divId).empty();
    counter = 0;
    for (var iter in inputs)
    {
        counter++;
        appendToDiv(divId, nameToUse, counter);
        $('#' + nameToUse + counter + 'Value input').val(inputs[iter]);
    }
}