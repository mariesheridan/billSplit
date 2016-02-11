$(document).ready(function(){
    var divId = "#app-summary";
    var totalPrice = computeTotalPrice(items);
    showItemSummary(divId, items, totalPrice, svcCharge);
    showPersonsSummary(divId, persons, items, totalPrice, svcCharge);
});

function showItemSummary(divId, itemsObject, totalPrice, serviceCharge)
{
    var appendValue = "<div id='summary-block'>";
    appendValue += divForHeader('Overview');
    appendValue += divForLine();
    for (iter in itemsObject)
    {
        appendValue += "<div class='summary-item-block'>";
        appendValue += divForItem(itemsObject[iter]['itemName']);
        appendValue += divForPrice(itemsObject[iter]['itemPrice'].toFixed(2));
        appendValue += "</div>";
    }
    appendValue += divForServiceCharge('', serviceCharge, false);
    appendValue += divForLine();
    appendValue += divForTotal(totalPrice + serviceCharge, false);
    appendValue += "</div>";

    $(divId).append(appendValue);
}

function showPersonsSummary(divId, personsArray, itemsObject, totalPrice, totalSvcCharge)
{
    computeTotalUnits(items);
    for (iter in personsArray)
    {
        var name = personsArray[iter];
        name = name;
        console.log("showPersonsSummary: " + personsArray[iter]);
        if (isPersonPaying(name.replace(/ /g, ''), itemsObject))
        {
            console.log("showPersonsSummary 2: " + name);
            showPerson(divId, name, itemsObject, totalPrice, totalSvcCharge);
        }
    }
}

function showPerson(divId, personName, itemsObject, totalPrice, totalSvcCharge)
{
    var payTotal = 0;
    var appendValue = divForSpacer();
    appendValue += "<div class='person-summary'>";
    appendValue += divForHeader(personName);
    appendValue += divForLine();
    for (iter in itemsObject)
    {
        if(isPersonPayingForItem(personName.replace(/ /g, ''), itemsObject[iter]))
        {
            var quantity = itemsObject[iter]['buyers'][personName.replace(/ /g, '')];
            var totalUnits = itemsObject[iter]['totalUnits'];
            var unitPrice = itemsObject[iter]['itemPrice'] / totalUnits;
            var payPrice = unitPrice * quantity;
            payTotal += payPrice;

            appendValue += "<div class='summary-item-block'>";
            appendValue += divForItem(itemsObject[iter]['itemName']);
            appendValue += divForQuantity(quantity);
            appendValue += divForUnitPrice(unitPrice.toFixed(2));
            appendValue += divForPrice(payPrice.toFixed(2));
            appendValue += divForHiddenInputs(personName, iter, quantity, unitPrice);
            appendValue += "</div>";
        }
    }
    var serviceCharge = (payTotal / totalPrice) * totalSvcCharge;
    payTotal += serviceCharge;
    appendValue += divForServiceCharge(personName, serviceCharge, true);
    appendValue += divForLine();
    appendValue += divForTotal(payTotal, true);
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

function computeTotalPrice(itemsObject, serviceCharge)
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

function divForServiceCharge(personName, serviceCharge, withPlaceholder)
{
    var appendValue = '';
    if (serviceCharge > 0)
    {
        appendValue += "<div class='summary-item-block'>";
        appendValue += divForItem('Service Charge');
        if (withPlaceholder)
        {
            appendValue += divForPlaceholder();
        }
        appendValue += divForPrice(serviceCharge.toFixed(2));
        if (withPlaceholder)
        {
            appendValue += divForHiddenInputs(personName, 'SvcCharge', 1, serviceCharge);
        }
        appendValue += "</div>";
    }
    return appendValue;
}

function divForPlaceholder()
{
    return "<div class='summary-placeholder'>&nbsp</div>";
}

function divForSpacer()
{
    return "<div class='app-spacer'></div>";
}

function divForTotal(input, withPlaceholder)
{
    var appendValue = "<div class='summary-item-block'><strong>";
    appendValue += divForItem('Total');
    if (withPlaceholder)
    {
        appendValue += divForPlaceholder();
    }
    appendValue += divForPrice(input.toFixed(2));
    appendValue += "</strong></div>";

    return appendValue;
}

function divForHiddenInputs(personName, itemName, quantity, unitPrice)
{
    var appendValue = "";
    appendValue += "<input type='hidden' name='" 
                + personName.replace(/ /g, '') + itemName 
                + "Qty' value='" 
                + quantity + "' />";
    appendValue += "<input type='hidden' name='" 
                + personName.replace(/ /g, '') + itemName 
                + "UnitPrice' value='" 
                + unitPrice + "' />";              
    return appendValue;
}