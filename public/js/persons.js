var counter = 1;
var idToAppend = '';
var isOneSet = false;
var persons = [];

$(document).ready(function () {

    var className = "";
    if (getIsClassSet())
    {
        className = getClassName();
        idToAppend = '#app-' + className + 's';
        if (!isEmpty(persons))
        {
            showPreviousInputs(idToAppend, className, persons, 'text');
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
        var values = getValues(idToAppend);
        showPreviousInputs(idToAppend, className, values, 'text');
    });

});

function setPersons(contentFromPhp)
{
    persons = contentFromPhp;
    for(iter in persons)
    {
        console.log("person: " + persons[iter]);
    }
}

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
