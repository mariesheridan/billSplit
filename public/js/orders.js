var isNameSet = false;
var name = '';
var counter = 1;
var idToAppend = '';

$(document).ready(function () {

    idToAppend = '#app-orders';
    listItems(idToAppend, 'order', itemNames, itemPrices);
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

function divForPrice(nameToUse, number, input)
{
    return "<div class='app-item-price' id='"
           + nameToUse + number + "ItemPrice'>Price: "
           + input + "</div>";
}

function divForShowDetails(nameToUse, number)
{
    return "<input type='button' class='app-show' id='" 
           + nameToUse + number + "Show' value='Split With' />";
}


function appendToDiv(divId, nameToUse, number, name, price)
{
    var appendValue = '';
    if (number > 1)
    {
        appendValue += divForSpacer(nameToUse, number);
    }
    appendValue += divForLabel(nameToUse, number);
    appendValue += divForItem(nameToUse, number, name);
    appendValue += divForPrice(nameToUse, number, price);
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

function listItems(divId, nameToUse, names, prices)
{
    console.log(names);
    $(divId).empty();
    counter = 0;
    for (var iter in names)
    {
        counter++;
        appendToDiv(divId, nameToUse, counter, names[iter], prices[iter]);
    }
}

