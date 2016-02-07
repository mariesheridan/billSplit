var isNameSet = false;
var name = '';
var counter = 1;
var idToAppend = '';
// persons, itemNames, itemPrices - taken from html

$(document).ready(function () {

    idToAppend = '#app-orders';
    listItems(idToAppend, 'order', itemNames, itemPrices, persons);

    $(document).on('click', '.app-show', function(){
        var showId = $(this).attr('id');
        var number = showId.match(/\d+/);
        var buyers = $('#buyers' + number);
        if (buyers.hasClass('hide'))
        {
            buyers.removeClass('hide');
            $(this).attr('value', 'Hide Details');
        }
        else
        {
            buyers.addClass('hide');
            $(this).attr('value', 'Split With');   
        }
    });

    // Require at least one checkbox checked per group
    $(document).on('click', '.nameCheckbox', function(){
        var requiredCheckboxes = $(this).closest('div.person-checkbox').find('input:checkbox');
        var atLeastOneChecked = false;
        requiredCheckboxes.each(function(){
            console.log("val: " + $(this).val());
            if ($(this).is(':checked'))
            {
                atLeastOneChecked = true;
            }
        });
        if (atLeastOneChecked)
        {
            requiredCheckboxes.removeAttr('required');
        }
        else
        {
            requiredCheckboxes.attr('required', 'required');
        }
    });

 
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

function divForPersons(nameToUse, number, names)
{
    var appendValue = "<div class='hide person-checkbox' id='buyers" + number +"'>";
    for (iter in names)
    {
        appendValue += "<div class='nameCheckbox' id='" 
                       + nameToUse + number
                       + names[iter] + "'><input type='checkbox' name='"
                       + nameToUse + number 
                       + "Name[]' value='" + names[iter] + "' required checked/>"
                       + names[iter] + "</div>";
    }
    appendValue += "</div>";
    return appendValue;
}


function appendToDiv(divId, nameToUse, number, name, price, personNames)
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
    appendValue += divForPersons(nameToUse, number, personNames);

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

function listItems(divId, nameToUse, names, prices, personNames)
{
    console.log(names);
    $(divId).empty();
    counter = 0;
    for (var iter in names)
    {
        counter++;
        appendToDiv(divId, nameToUse, counter, names[iter], prices[iter], personNames);
    }
}

