$(document).ready(function(){
    var divId = "#app-summary";
    computeTotalUnits(items);
    showItemSummary(divId, items);
});

function showItemSummary(divId, itemsObject)
{
    var appendValue = "<div id='summary-block'>";
    appendValue += divForHeader('Overview');
    appendValue += divForLine();
    var counter = 1;
    for (iter1 in itemsObject)
    {
        appendValue += "<div class='app-item-block'>";
        appendValue += divForItem(iter1);
        appendValue += divForPrice(itemsObject[iter1]['itemPrice']);
        appendValue += "</div>";
        counter++;
    }
    appendValue += divForLine();
    appendValue += divForItem('Total Price');
    appendValue += divForPrice(computeTotalPrice(itemsObject));
    appendValue += "</div>";

    $(divId).append(appendValue);
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
    return "<div class='app-item-name'>"
           + input + "</div>";
}

function divForPrice(input)
{
    return "<div class='app-item-price'>"
           + input + "</div>";
}

function divForLine()
{
    return "<div class='app-line-space'></div>"
           + "<div class='app-line'></div>"
           + "<div class='app-line-space'></div>";
}