var counter = 1;
var idToAppend = '';
var isOneSet = false;
// itemNames and itemPrices - taken from html

$(document).ready(function () {

    var className = "";
    if (getIsClassSet())
    {
        className = getClassName();
        idToAppend = '#app-' + className + 's';
        if (!isEmpty(itemNames))
        {
            showPreviousInputs(idToAppend, className, itemNames, itemPrices);
        }
        else if(!getIsOneSet())
        {
            setOne(idToAppend, className);
        }
        $("#addRow").click(function () {
            counter++;
            appendToDiv(idToAppend, className, counter);
            $(".app-value :last").focus();
        });
    }
    $(document).on('click', '.app-remove', function(){
        var removeId = $(this).attr('id');
        var number = removeId.match(/\d+/);
        removeId = "#" + removeId;
        var labelId = "#" + className + number + "Label";
        var valueId = "#" + className + number + "Value";
        var spacerId = "#" + className + number + "Spacer";
        var priceId =  "#" + className + number + "Price";
        $(removeId).remove();
        $(labelId).remove();
        $(valueId).remove();
        $(spacerId).remove();
        $(priceId).remove();
        var names = getValues('.app-value');
        var prices = getValues('.app-price');
        showPreviousInputs(idToAppend, className, names, prices);
    });
    $("#app-form").submit(function(event){
        if(!checkUnique())
        {
            alert("Please enter unique items!");
            event.preventDefault(); 
        }
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
    appendValue += divForPrice(nameToUse, number);
    if (number > 1)
    {
        appendValue += divForRemove(nameToUse, number);
    }
    $(divId).append(appendValue);
}

function showPreviousInputs(divId, nameToUse, names, prices)
{
    console.log("showPreviousInputs names: " + names);
    console.log("showPreviousInputs prices: " + prices);
    $(divId).empty();
    counter = 0;
    for (var iter in names)
    {
        counter++;
        appendToDiv(divId, nameToUse, counter);
        $('#' + nameToUse + counter + 'Value input').val(names[iter]);
        $('#' + nameToUse + counter + 'Price input').val(prices[iter]);
    }
}