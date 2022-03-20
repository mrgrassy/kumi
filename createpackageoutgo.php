<?php
require_once ('KUMI.php');
$kumi = New KUMI\KUMI();
$kumi = $kumi   ->setUsername("TestUser") // It is a test user DON'T USE IT IN PRODUCTION!!!
				->setPassword("TestPass") // It is a test password DON'T USE IT IN PRODUCTION!!!
				->setCompanySite(1) // It is a Test Company site ID
				->setRecorder("Rőgzítő") // It is a Recorder name
				->setPayoutmode(0) // Payout-mode like transfer or cash
				->setPackageTypeId(1) //PackageType 1=> OutDelivery 2=> InDelivery
				->setPackageStatus(1) // Package start of status 1=> recorded package
				->setPackageCondition(1); // Package Condition 1=>Active
//Sender's data
$kumi = $kumi   ->setSenderName("Test Tamás KFT") // Sender Name
				->setSenderContactname("Test Tamás") // Contact name like John Doe
				->setSenderPhone("205610738") // Phone Number without country code (+36)
				->setSenderEmail("braviklacy@msn.com")// Email address
				->setSenderZipcode("2225") // Zipcode
				->setSenderCity("Üllő") // City
				->setSenderAddress("Halomhatár utca") // street name and street type example: Andrassy street
				->setSenderHousenumber(2955) // ONLY HOUSENUMBER
				->setSenderExtraInfo("/2") // extra info like /b or 2. House az A building
				->setSenderDescription("A Kék csengő") // Other info for address example: Blue door 2. floor
				->setSenderPrice(0) //COD amount
				->setSenderCurrency(1) //COD currency 1=> Forint
				->setSenderCreaditcard(1) // 1=> CreditCard 0=>Cash
				->setSenderDate("2022.03.08");  //Date of admission
//Recipient's data
$kumi = $kumi   ->setRecipientName("Teszt Tamás KFT") // Recipient Name
				->setRecipientContactname("Teszt Tamás") // Contact name like John Doe
				->setRecipientPhone("205610738") // Phone Number without country code (+36)
				->setRecipientEmail("braviklacy@msn.com") // Email address
				->setRecipientZipcode("2225")// Zipcode
				->setRecipientCity("Üllő") // City
				->setRecipientAddress("Halomhatár utca") // street name and street type example: Andrassy street
				->setRecipientHousenumber(55) // ONLY HOUSENUMBER
				->setRecipientExtraInfo("/2") // extra info like /b or 2. House az A building
				->setRecipientDescription("A Kék csengő") //
				->setRecipientPrice(10000) // COD amount
				->setRecipientCurrency(1) //COD currency 1=> Forint
				->setRecipientCreaditcard(0) // 1=> CreditCard 0=>Cash
				->setRecipientDate("2022.03.09"); //Delivery date
//PackageData
$kumi = $kumi   ->setContent("Tartalom") // Package Content
				->setBoxes(1) // Package box number (Minimum: 1)
				->setWeight(1) // Weight in KG (Minimum: 1)
				->setCustomerForeignIdentifier("TTKFT-01") // Customer Identifier like Ordernumber or invoice
				->setCostDeclaration(0) // Package Price
				->setCostDeclarationCurrency(1) //Package Price Currency 1=> Forint
				->setComment("Megjegyzés") // Comment for Currier
				->setExtraServices([1,2,3,4,5,6,7]); // Extra services

//2. Back Package datas (only exchange package)
$kumi = $kumi   ->setContent("Tartalom") //Package Content
				->setBoxes(1) // Package box number (Minimum: 1)
				->setWeight(1) // Weight in KG (Minimum: 1)
				->setCustomerForeignIdentifier("TTKFT-02")  // Customer Identifier like Ordernumber or invoice
				->setCostDeclaration(0) // Package Price
				->setCostDeclarationCurrency(1) //Package Price Currency 1=> Forint
				->setComment("Megjegyzés") // Comment for Currier
				->setExtraServices([1,2,3,4,5,6,7]); // Extra services
$kumi->createPackage();

