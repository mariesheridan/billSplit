var isNameSet = false;
var name = '';
var counter = 1;
var idToAppend = '';
var isOneSet = false;
var persons = [];
var items = [];
var isItem = false;

$(document).ready(function () {

    idToAppend = '#app-orders';
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
        updateDiv(idToAppend, name);
    });

});

function setPersons(contentFromPhp)
{
    persons = contentFromPhp;
    for(iter in persons)
    {
        console.log("content: " + persons[iter]);
    }
}

function setItems(contentFromPhp)
{
    items = contentFromPhp;
    for(iter in items)
    {
        console.log("content: " + items[iter]);
    }
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

function divForRemove(nameToUse, number)
{
    return "<input type='button' class='app-remove' id='" 
           + nameToUse + number + "Remove' value='Remove' />";
}

// function divForPrice(nameToUse, number)
// {
    // return "<div class='app-price' id='"
           // + nameToUse + number
           // + "Price'><input type='number' name='"
           // + nameToUse + number + "' required></div>";
// }

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
    // if (isItem)
    // {
        // appendValue += divForPrice(nameToUse, number);
    // }
    if (number > 1)
    {
        appendValue += divForRemove(nameToUse, number);
    }
    $(divId).append(appendValue);
}

function updateDiv(divId, nameToUse)
{
    var values = getValues();
    console.log(values);
    $(divId).empty();
    counter = 0;
    for (var iter in values)
    {
        counter++;
        appendToDiv(divId, nameToUse, counter);
        $('#' + nameToUse + counter + 'Value :text').val(values[iter]);
    }
}

function getValues()
{
    var values = [];
    $(idToAppend + " :text").each(function(){
        values.push($(this).val());
    });
    return values;
}
