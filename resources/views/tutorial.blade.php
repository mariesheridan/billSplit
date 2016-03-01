<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bill Split Tutorial</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <!--<link href="../../../public/css/reset.css" rel="stylesheet">-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
<!--    <link href="/css/style.css" rel="stylesheet">-->
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <div class="navbar-brand">Bill Split Tutorial</div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" id="top">Frequently Asked Questions</div>
                    <div class="panel-body">
                        <ol>
                            <li><a href="#billsplitdescription">What does BillSplit do?</a></li>
                            <li><a href="#interpretreceivables">What is the <i>Receivables</i> section?</a></li>
                            <li><a href="#interpretpayables">What is the <i>Payables</i> section?</a></li>
                            <li><a href="#createtransaction">How do I create a transaction?</a></li>
                            <li><a href="#viewingtransaction">How do I view the transaction?</a></li>
                            <li><a href="#editingtransaction">How do I edit the transaction?</a></li>
                            <li><a href="#howtoassignstatuses">How can I assign statuses to the transaction?</a></li>
                            <li><a href="#servicechargeexplained">What is the service charge?</a></li>
                            <li><a href="#taggingexplained">How does tagging work?</a></li>
                            <li><a href="#sendingnotification">How do I an send email notification to my friends? What does the notification contain?</a></li>
                            <li><a href="#addfriends">How do I add friends?</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" id="billsplitdescription">What does BillSplit do?</div>
                    <div class="panel-body">
                        <p>BillSplit is an application created for tracking bills that are shared among multiple people.</p>
                        <p>You can do the following with BillSplit:</p>
                        <ol>
                            <li>Compute the amount that each person in the group has the pay</li>
                            <li>Track who already settled the payment (for the person who paid the bill on behalf of the whole group)</li>
                            <li>Track the unpaid items (for the other persons who owe the one who paid the bill)</li>
                            <li>Send the bill to the person via email</li>
                            <li>Send email reminders about the status of the person's bill</li>
                        </ol>
                        <a href="#top">Back to Top</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" id="interpretreceivables">What is the <i>Receivables</i> section?</div>
                    <div class="panel-body">
                        <p>The <i>Receivables</i> section is where the users can see the transactions that they have created. </p>
                        <p>Each transaction has the following information:</p>
                        <ol>
                            <li>Date</li>
                            <li>Store</li>
                            <li>The persons sharing the bill with them</li>
                            <li>The total price of the bill</li>
                            <li>Status of the bill</li>
                            <li>Link for sending reminders</li>
                            <li>Link for editing</li>
                        </ol>
                        <div><img id="tutorial01"></div>
                        <p>The transactions are sorted by status in this order:<p>
                        <ol>
                            <li><b>Verifying</b><br>There is at least one person in the group who already paid their balance. The user has to verify this payment by clicking on the store name.</li>
                            <li><b>Unpaid</b><br>There is at least one person in the group who still hasn't paid.</li>
                            <li><b>Paid</b><br>Everyone in the group already paid the bill.</li>
                        </ol>
                        <a href="#top">Back to Top</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" id="interpretpayables">What is the <i>Payables</i> section?</div>
                    <div class="panel-body">
                        <h4>Payables</h4>
                        <p>The <i>Payables</i> section is where the users can see the bills that they have to pay. </p>
                        <p>Each transaction has the following information:</p>
                        <ol>
                            <li>Date</li>
                            <li>Store</li>
                            <li>The person to whom they owe money</li>
                            <li>The amount that they have to pay</li>
                            <li>Status of the bill</li>
                        </ol>
                        <div><img id="tutorial02"></div>
                        <p>The transactions are sorted by status in this order:<p>
                        <ol>
                            <li><b>Unpaid</b></li>
                            <li><b>Verifying</b></li>
                            <li><b>Paid</b></li>
                        </ol>
                        <a href="#top">Back to Top</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" id="createtransaction">How do I create a transaction?</div>
                    <div class="panel-body">
                        <p>Steps to create a transaction:</p>
                        <ol>
                            <li>
                                Find the "Create" button in the menu bar.
                                <div><img id="tutorial03"></div>
                            </li>
                            <li>
                                Enter the store name and date.
                                <div><img id="tutorial04"></div>
                            </li>
                            <li>
                                You can add friends from your Friends List. In this case, your friends will be tagged automatically. To include your friends in the list, click on "Add From Friends List", then check the names.
                                <div><img id="tutorial14"></div>
                                However, you can still add people that are not saved in your Friends List, then you just have to tag them later. <a href="#taggingexplained">(How does tagging work?)</a>
                                <br>
                                Enter the names of the people sharing the bill, including yourself if you are part of the bill. You don't have to put yourself if you just paid on behalf of the group, but you did not really consume anything.
                                <div><img id="tutorial05"></div>
                            </li>
                            <li>
                                Enter the items bought and their corresponding prices. Include a service charge if applicable. <a href="#servicechargeexplained">(What is the service charge?)</a>
                                <div><img id="tutorial06"></div>
                            </li>
                            <li>
                                You can set the persons sharing a particular item in the bill, including the quantity of their share. For example, Marie ate half of the Banana bread, then Marvin and Crista both ate a quarter, you can set the quantity as:
                                <ol>
                                    <li>Crista: checked, Qty: 0.25</li>
                                    <li>Marie: checked, Qty: 0.5</li>
                                    <li>Marvin: checked, Qty: 0.25</li>
                                    <li>Sab: unchecked</li>
                                </ol>
                                Or use the ratio instead of the actual portion size. The example below is the same as the one above.
                                <ol>
                                    <li>Crista: checked, Qty: <b>1</b></li>
                                    <li>Marie: checked, Qty: <b>2</b></li>
                                    <li>Marvin: checked, Qty: <b>1</b></li>
                                    <li>Sab: unchecked</li>
                                </ol>
                                <div><img id="tutorial07"></div>
                                The default for an item is that all persons are checked with quantity equal to 1.
                            </li>
                            <li>
                                Click the Next button so you can be directed to the Summary page, where you can check if the previous inputs are correct.
                                <div><img id="tutorial08"></div>
                            </li>
                            <li>
                                After verifying that all details are correct, click the Save button to save this transaction. Now, your transaction is saved, and you will be directed to the confirmation page on whether to send notification to your friends or not.
                                <div><img id="tutorial15"></div>
                            </li>
                            <li>
                                In either case, you will be directed to your home page. Now, you can see this transaction in the <i>Receivables</i> section.
                                <div><img id="tutorial09"></div>
                            </li>
                        </ol>
                        <a href="#top">Back to Top</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" id="viewingtransaction">How do I view the transaction?</div>
                    <div class="panel-body">
                        <p>You can see the transactions in your dashboard. In order to view the details of the transaction, just click on the store name in the <i>Receivables</i> or <i>Payables</i> section.</p>
                        <p>When you click on the store name in the <i>Receivables</i> section, you will be able to see all the status of each individual's payment. You can set them to Paid if they already paid their share.</p>
                        <p>When you click on the store name in the <i>Payables</i> section, you will only see the status of the item where you are tagged. <a href="#taggingexplained">(How does tagging work?)</a></p>
                        <a href="#top">Back to Top</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" id="editingtransaction">How do I edit the transaction?</div>
                    <div class="panel-body">
                        <p>You can see the transactions in your dashboard. In order to edit the details of the transaction, just click on the Edit link in the <i>Receivables</i> section.</p>
                        <p>Then, follow the steps in creating a transaction. <a href="#createtransaction">(How do I create a transaction?)</a></p>
                        <a href="#top">Back to Top</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" id="howtoassignstatuses">How can I assign statuses to the transaction?</div>
                    <div class="panel-body">
                        <p>There are three statuses assigned to a transaction: Unpaid, Verifying and Paid.</p>
                        <ul>
                            <li><b>Unpaid</b><br>When a transaction is created, the default value is unpaid.</li>
                            <li><b>Verifying</b><br>In the <i>Payables</i> section, the user can set their outstanding balance as Paid. However, this will not change the status directly to Paid. The status will become Verifying first, and the creator of the transaction will see this change in their <i>Payables</i> section. Then the creator can confirm if the payment has been received already, after which, they can officially set the status as Paid.</li>
                            <li><b>Paid</b><br>This status can only be set by the creator of the transaction, in the <i>Receivables</i> section.</li>
                        </ul>
                        <a href="#top">Back to Top</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" id="servicechargeexplained">What is the service charge?</div>
                    <div class="panel-body">
                        <p>There are instances where the restaurant will ask for a service charge that is a percentage of the total amount of items you bought. In order to be fair in the division of the bill, the service charge should be computed also as a percentage of each individual's share of the total bill.</p>
                        <p>Example:</p>
                        <p>Your bill at a restaurant is 50 dollars. The restaurant asked for a 10% service charge, so the total bill is now 55 dollars. Marvin and Marie are sharing the bill. Marvin ordered food worth 30 dollars, while Marie's food is only 20 dollars.</p>
                        <p>Since Marvin's food (worth 30 dollars) is 60% of the total bill, which is 50 dollars, Marvin's share in the service charge will be 60% also, which is 3 dollars. Marvin will pay 33 dollars.</p>
                        <p>The computation for Marie is the same. Since she only ordered 40% of the bill, she will only pay 40% of the service charge. That makes her payable 22 dollars.</p>
                        <a href="#top">Back to Top</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" id="taggingexplained">How does tagging work?</div>
                    <div class="panel-body">
                        <p>The creator of the transaction can tag the email of the persons who share the bill. Once tagged, that person will be able to see the transaction in their <i>Payables</i> section upon signing in.</p><p>You can tag any email even if it is not yet registered in the app. When the person who owns that email registers later, they will automatically see the bill in their <i>Payables</i> section.</p>
                        <p>There are two ways to tag a person:</p>
                        <ol>
                            <li>
                                <p>During creation of the transaciton, click on "Add from Friends List", and select the friends that are included in the purchase. The friends selected here will be automatically tagged when the transaction is saved.</p>
                                <div><img id="tutorial16"></div>
                                <div><img id="tutorial14"></div>
                            </li>
                            <li>
                                <p>Using the Remind link in the <i>Receivables</i> section, you can set the email of the persons included in the transaction.</p>
                                <div><img id="tutorial10"></div>
                                <p>Click the Edit link for the person, and you can put in a different email, or select existing emails from your friends list.</p>
                                <div><img id="tutorial17"></div>
                            </li>
                        </ol>
                        <p>
                            Crista, Marie, Marvin, and Sab are now tagged in this transaction.
                        </p>
                        <p>
                            When Marie logs in with marie@yahoo.com, and she will be able to see the transaction in her <i>Payables</i> section. When she goes to the transaction details, she will be able to see the status of the item where she is tagged, but she won't see the status of the others.
                            <div><img id="tutorial11"></div>
                        </p>
                        <a href="#top">Back to Top</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" id="sendingnotification">How do I an send email notification to my friends? What does the notification contain?</div>
                    <div class="panel-body">
                        <p>To send an email notification, just check the Send Notification box beside the name of the person in the Tag page, and click on Save & Send.</p>
                        <p>The notification contains details of the transaction and to whom the person should pay the amount.</p>
                        <div><img id="tutorial12"></div>
                        <a href="#top">Back to Top</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" id="addfriends">How do I add friends?</div>
                    <div class="panel-body">
                        <p>To add friends, click on Friends found on the menu bar.</p>
                        <p>Just type in the name and email address at the designated textboxes. You should use unique names, but you can save a single email address under different names.</p>
                        <div><img id="tutorial13"></div>
                        <a href="#top">Back to Top</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>