$(document).ready(function(){
    var divId = "#app-summary";
    showItemSummary(divId, items);
    showPersonsSummary(divId, persons, items);
});

function showItemSummary(divId, itemsObject)
{
    var appendValue = "<div id='summary-block'>";
    appendValue += divForHeader('Overview');
    appendValue += divForLine();
    for (iter in itemsObject)
    {
        appendValue += "<div class='app-item-block'>";
        appendValue += divForItem(iter);
        appendValue += divForPrice(itemsObject[iter]['itemPrice'].toFixed(2));
        appendValue += "</div>";
    }
    appendValue += divForLine();
    appendValue += divForItem('Total Price');
    appendValue += divForPrice(computeTotalPrice(itemsObject).toFixed(2));
    appendValue += "</div>";

    $(divId).append(appendValue);
}

function showPersonsSummary(divId, personsArray, itemsObject)
{
    computeTotalUnits(items);
    for (iter in personsArray)
    {
        var name = personsArray[iter];
        console.log("showPersonsSummary: " + personsArray[iter]);
        if (isPersonPaying(name, itemsObject))
        {
            console.log("showPersonsSummary 2: " + name);
            showPerson(divId, name, itemsObject);
        }
    }
}

function showPerson(divId, personName, itemsObject)
{
    var payTotal = 0;
    var appendValue = divForSpacer();
    appendValue += "<div class='person-summary'>";
    appendValue += divForHeader(personName);
    appendValue += divForLine();
    for (iter in itemsObject)
    {
        if(isPersonPayingForItem(personName, itemsObject[iter]))
        {
            var quantity = itemsObject[iter]['buyers'][personName];
            var totalUnits = itemsObject[iter]['totalUnits'];
            var unitPrice = itemsObject[iter]['itemPrice'] / totalUnits;
            var payPrice = unitPrice * quantity;
            payTotal += payPrice;

            appendValue += "<div class='app-item-block'>";
            appendValue += divForItem(iter);
            appendValue += divForQuantity(quantity);
            appendValue += divForUnitPrice(unitPrice.toFixed(2));
            appendValue += divForPrice(payPrice.toFixed(2));
            appendValue += "</div>";
        }
    }
    appendValue += divForLine();
    appendValue += divForItem('Total');
    appendValue += divForPlaceholder();
    appendValue += divForPrice(payTotal.toFixed(2));
    appendValue += divForSpacer();
    appendValue += "</div>";
    $(divId).append(appendValue);
}

function isPersonPaying(personName, itemsObject)
{
    var personIsPaying = false;
    for (iter in itemsObject)
    {
        if (itemsObject[iter]['buyers'].hasOwnProperty(personName))
        {
            personIsPaying = true;
        }
    }
    console.log(personName + ' is paying = ' + personIsPaying);
    return personIsPaying;
}

function isPersonPayingForItem(personName, itemArray)
{
    if (itemArray['buyers'].hasOwnProperty(personName))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function computeTotalUnits(itemsObject)
{
    for (iter1 in itemsObject)
    {
        var totalUnits = 0;
        for (iter2 in itemsObject[iter1]['buyers'])
        {
            totalUnits += itemsObject[iter1]['buyers'][iter2];
        }
        console.log(iter1 + " units = " + totalUnits);
        itemsObject[iter1]['totalUnits'] = totalUnits;
    }
}

function computeTotalPrice(itemsObject)
{
    var totalPrice = 0;
    for (iter in itemsObject)
    {
        totalPrice += itemsObject[iter]['itemPrice'];
    }
    return totalPrice;
}

function divForHeader(title)
{
    return "<h4>" + title + "</h4>";
}

function divForItem(input)
{
    return "<div class='summary-item-name'>"
           + input + "</div>";
}

function divForPrice(input)
{
    return "<div class='summary-item-price'>"
           + input + "</div>";
}

function divForQuantity(input)
{
    return "<div class='summary-qty'>"
           + input + "</div>";
}

function divForUnitPrice(input)
{
    return "<div class='summary-unit-price'>@"
           + input + "</div>";
}

function divForLine()
{
    return "<div class='app-line-space'></div>"
           + "<div class='app-line'></div>"
           + "<div class='app-line-space'></div>";
}

function divForPlaceholder()
{
    return "<div class='summary-placeholder'>&nbsp</div>";
}

function divForSpacer()
{
    return "<div class='app-spacer'></div>";
}