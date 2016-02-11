var isClassSet = false;
var className = '';

function getIsClassSet()
{
    return isClassSet;
}

function setClass(nameToUse)
{
    className = nameToUse;
    isClassSet = true;
}

function getClassName()
{
    return className;
}

function isEmpty(inputArray)
{
/*    if (inputArray.length <= 0)
    {
        //console.log('Array is empty!')
        return true;
    }
    else
    {
        //console.log('Array is NOT empty!')
        return false;
    }
*/
    var counter = 0;
    var result = true;
    for (iter in inputArray)
    {
        console.log('Not empty. ' + iter + " = " + inputArray[iter]);
        counter++;
    }
    if (counter > 1)
    {
        result =  false;
    }
    return result;
}

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

function divForValue(nameToUse, number)
{
    return "<div class='app-value' id='"
           + nameToUse + number
           + "Value'><input type='text' name='"
           + nameToUse + number + "' autofocus required></div>";
}

function divForRemove(nameToUse, number)
{
    return "<input type='button' class='app-remove' id='" 
           + nameToUse + number + "Remove' value='Remove' />";
}

function divForPrice(nameToUse, number)
{
    return "<div class='app-price' id='"
           + nameToUse + number
           + "Price'>Price: <input type='number' step='0.01' name='price"
           + number + "' required /></div>";
}

function getValues(fromDivId)
{
    var values = [];
    console.log("Entered getValues()");
    $('div' + fromDivId).find('input').each(function(){
        console.log($(this).val());
        values.push($(this).val());
    });
    return values;
}

function checkUnique()
{
    var inputs = [];
    $('.app-value').each(function(){
        console.log("id: " + $(this).attr('id'));
        input = $(this).find('input:text').val().replace(/ /g, "").toLowerCase();
        console.log('input: ' + input);
        inputs.push(input);
    });
    var unique = true;
    console.log('checkUnique: ' + inputs);
    for (iter1 in inputs)
    {
        for (iter2 in inputs)
        {
            if ((iter1 != iter2) && (inputs[iter2] == inputs[iter1]))
            {
                console.log("iter1: " + iter1 + ", iter2: " + iter2 + ", value= " + inputs[iter2]);
                unique = false;
                break;
            }
        }
        if (!unique)
        {
            break;
        }
    }
    return unique;
}

function getIsOneSet()
{
    return isOneSet;
}