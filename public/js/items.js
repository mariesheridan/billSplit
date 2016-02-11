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
            //showPreviousInputs(idToAppend, className, itemNames, itemPrices);
            showPreviousInputs(idToAppend, className, items);
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
        /*var removeId = $(this).attr('id');
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
        $(priceId).remove();*/
        $(this).closest('.item-block').children().each(function(){
            console.log("removing " + $(this).attr('id'));
            $(this).remove();
        });
        var names = getValues('.app-value');
        var prices = getValues('.app-price');
        showCurrentInputs(idToAppend, className, names, prices);
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
    var appendValue = "<div class='item-block' data-number='" + 1 + "'>";
    appendValue += divForLabel(nameToUse, 1);
    appendValue += divForValue(nameToUse, 1);
    appendValue += divForPrice(nameToUse, 1);
    appendValue += "</div>";
    $(id).append(appendValue);
    isOneSet = true;
}

function appendToDiv(divId, nameToUse, number)
{
    if (number === 2)
    {
        $(".item-block").append(divForRemove(className, counter-1));
    }
    var appendValue = "<div class='item-block' data-number='" + number + "'>";
    /*if (number === 2)
    {
        appendValue += divForRemove(nameToUse, number-1);
    }*/
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
    appendValue += "</div>";
    $(divId).append(appendValue);
}

function showPreviousInputs(divId, nameToUse, inputs)
{
    $(divId).empty();
    counter = 0;
    for (iter in inputs)
    {
        counter++;
        appendToDiv(divId, nameToUse, counter);
        $('#' + nameToUse + counter + 'Value input').val(inputs[iter]['itemName']);
        $('#' + nameToUse + counter + 'Price input').val(inputs[iter]['itemPrice']);
    }
}

function showCurrentInputs(divId, nameToUse, names, prices)
{
    console.log("showCurrentInputs names: " + names);
    console.log("showCurrentInputs prices: " + prices);
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