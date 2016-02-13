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
    var counter = 0;
    var result = true;
    for (iter in inputArray)
    {
        counter++;
        break;
    }
    if (counter > 0)
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
    var result = {};
    $('.app-value').each(function(){
        console.log("id: " + $(this).attr('id'));
        var id = $(this).attr('id');
        input = $(this).find('input:text').val().replace(/[^a-zA-Z0-9]/g, "").toLowerCase();
        console.log('input: ' + input);
        inputs.push(input);
    });
    var unique = true;

    for (iter1 in inputs)
    {
        for (iter2 in inputs)
        {
            if ((iter1 != iter2) && (inputs[iter2] == inputs[iter1]))
            {
                console.log("iter1: " + iter1 + ", iter2: " + iter2 + ", value= " + inputs[iter2]);
                result['num1'] = parseInt(iter1) + 1;
                result['num2'] = parseInt(iter2) + 1;
                unique = false;
                break;
            }
        }
        if (!unique)
        {
            break;
        }
    }
    result['isUnique'] = unique;
    return result;
}

function getIsOneSet()
{
    return isOneSet;
}

function divForError(num1, num2)
{
    return "<span class='help-block'><strong>Please put in unique values<br>Inputs " 
           + num1 + " and " + num2 + " are the same!</strong></span>";
}

function validateForm()
{
    var checkResult = checkUnique();
    $("#" + getClassName() + "-body").find('.help-block').each(function(){
        $(this).remove();
    });
    if(!checkResult.isUnique)
    {
        $("#" + getClassName() + "-body").prepend(divForError(checkResult['num1'], checkResult['num2']));
        event.preventDefault(); 
    }
}
