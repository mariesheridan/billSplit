var isNameSet = false;
var name = '';
var counter = 1;
var idToAppend = '';

$(document).ready(function () {

    idToAppend = '#app-orders';
    if (isItemsSet)
    {
        listItems(idToAppend, 'order', items);
    }

});

function divForSpacer(nameToUse, number)
{
    return "<div class='app-spacer' id='" + nameToUse + number + "Spacer'></div>";
}

function divForLabel(nameToUse, number)
{
    return "<div class='app-label' id='"
           + nameToUse + number + "Label'>"
           + number + ".</div>";
}

function divForItem(nameToUse, number, input)
{
    return "<div class='app-item-name' id='"
           + nameToUse + number + "ItemName'>"
           + input + "</div>";
}

function divForPrice(nameToUse, number, value)
{
    return "<div class='app-price' id='"
           + nameToUse + number
           + "Price'>Total Price: <input type='number' step='0.01' name='price"
           + number + "' value='" + value + "' required></div>";
}

function divForShowDetails(nameToUse, number)
{
    return "<input type='button' class='app-show' id='" 
           + nameToUse + number + "Show' value='Split With' />";
}


function appendToDiv(divId, nameToUse, number, input)
{
    var appendValue = '';
    if (number > 1)
    {
        appendValue += divForSpacer(nameToUse, number);
    }
    appendValue += divForLabel(nameToUse, number);
    appendValue += divForItem(nameToUse, number, input);
    appendValue += divForPrice(nameToUse, number, findPriceForItem(input, prices));
    appendValue += divForShowDetails(nameToUse, number);

    $(divId).append(appendValue);
}

function findPriceForItem(itemName, priceList)
{
    for (iter in priceList)
    {
        if (priceList[iter].priceName === itemName)
        {
            return priceList[iter].priceAmount;
        }
    }
    return "";
}

function listItems(divId, nameToUse, inputs)
{
    console.log(inputs);
    $(divId).empty();
    counter = 0;
    for (var iter in inputs)
    {
        counter++;
        appendToDiv(divId, nameToUse, counter, inputs[iter]);
    }
}

