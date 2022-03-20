<?php
/**
 * @author Mr.Grassy
 * @email braviklacy@msn.com
 * @phone +36205610738
 */
namespace KUMI;

class KUMI
{
	// <editor-fold desc="PARAMS">
	/**
	 * @var string
	 */
	private string $username;
	/**
	 * @var string
	 */
	private string $password;
	/**
	 * @var string
	 */
	private string $recorder;
	/**
	 * @var string
	 */
	private string $company_site;
	/**
	 * @var int
	 */
	private int $package_type_id;
	/**
	 * @var string
	 */
	private string $sender_name;
	/**
	 * @var string|null
	 */
	private ?string $sender_contactname;
	/**
	 * @var int
	 */
	private int $sender_zipcode;
	/**
	 * @var string
	 */
	private string $sender_city;
	/**
	 * @var string
	 */
	private string $sender_address;
	/**
	 * @var int
	 */
	private int $sender_housenumber;
	/**
	 * @var string
	 */
	private string $sender_extra_info;
	/**
	 * @var string
	 */
	private string $sender_description;
	/**
	 * @var string
	 */
	private string $sender_phone;
	/**
	 * @var string
	 */
	private string $sender_email;
	/**
	 * @var mixed
	 */
	private mixed $sender_price;
	/**
	 * @var int
	 */
	private int $sender_currency;
	/**
	 * @var int
	 */
	private int $sender_creaditcard;
	/**
	 * @var mixed
	 */
	private mixed $sender_date;
	/**
	 * @var string
	 */
	private string $recipient_name;
	/**
	 * @var string
	 */
	private string $recipient_contactname;
	/**
	 * @var int
	 */
	private int $recipient_zipcode;
	/**
	 * @var string
	 */
	private string $recipient_city;
	/**
	 * @var string
	 */
	private string $recipient_address;
	/**
	 * @var int
	 */
	private int $recipient_housenumber;
	/**
	 * @var string
	 */
	private string $recipient_extra_info;
	/**
	 * @var string
	 */
	private string $recipient_description;
	/**
	 * @var string
	 */
	private string $recipient_phone;
	/**
	 * @var string
	 */
	private string $recipient_email;
	/**
	 * @var mixed
	 */
	private mixed $recipient_price;
	/**
	 * @var int
	 */
	private int $recipient_currency;
	/**
	 * @var int
	 */
	private int $recipient_creaditcard;
	/**
	 * @var mixed
	 */
	private mixed $recipient_date;
	/**
	 * @var string
	 */
	private string $content;
	/**
	 * @var string
	 */
	private string $foreign_identifier;
	/**
	 * @var int
	 */
	private int $boxes;
	/**
	 * @var int
	 */
	private int $weight;
	/**
	 * @var int
	 */
	private int $cost_declaration;
	/**
	 * @var int
	 */
	private int $cost_declaration_currency;
	/**
	 * @var string
	 */
	private string $comment;
	/**
	 * @var string
	 */
	private string $content2;
	/**
	 * @var string
	 */
	private string $foreign_identifier2;
	/**
	 * @var int
	 */
	private int $boxes2;
	/**
	 * @var int
	 */
	private int $weight2;
	/**
	 * @var int
	 */
	private int $cost_declaration2;
	/**
	 * @var int
	 */
	private int $cost_declaration_currency2;
	/**
	 * @var string
	 */
	private string $comment2;
	/**
	 * @var int
	 */
	private int $payoutmode;
	/**
	 * @var string
	 */
	private string $banckaaccount_id;
	/**
	 * @var string
	 */
	private string $customer_foreign_identifier;
	/**
	 * @var mixed
	 */
	private mixed $extra_services;
	private int $package_status;
	private int $package_condition;
	// </editor-fold>
	// <editor-fold desc="ACTIONS">
	/**
	 * @return \KUMI\KUMIResult
	 */
	public function createPackage(): KUMIResult
	{
		$data = $this->getDatasArray();
		$url = 'https://csomagkezeles.hu/api/createPackage';
		$ch = curl_init($url);
		$postString = http_build_query($data, '', '&');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$return_data= json_decode($response);
		$result=null;
		if($return_data) {
			$result = new KUMIResult();
			$result->setSuccessfull(boolval($return_data->successfull));
			if ($return_data->successfull) {
				$packages = [];
				foreach ($return_data->datas->packages as $index => $package) {
					$packages[$index] = new KUMIPackage();
					$packages[$index]->setCustomerForeignIdentifier($package->customer_foreign_identifier);
					$packages[$index]->setFollowlink($package->followlink);
					$packages[$index]->setSecurecode($package->securecode);
					$packages[$index]->setPackagenumber($package->packagenumber);
					$packages[$index]->setShowablePackagenumber($package->showable_packagenumber);
				}
				$result->setPackage($packages);
			} else {
				$error = new KUMIError();
				$error->setCode($return_data->error->code);
				$error->setDescription($return_data->error->description);
				$result->setError($error);
			}
		}
		return $result;
	}
	// </editor-fold>
	// <editor-fold desc="GETTER">
	/**
	 * @return array
	 */
	public function getDatasArray():array
	{
		return array(
			'username'                      => $this->username,
			'password'                       => $this->password,
			'recorder'                       => $this->recorder,
			'company_site'                   => $this->company_site,
			'package_type_id'                => $this->package_type_id,
			'sender_name'                    => $this->sender_name,
			'sender_contactname'             => $this->sender_contactname,
			'sender_zipcode'                 => $this->sender_zipcode,
			'sender_city'                    => $this->sender_city,
			'sender_address'                 => $this->sender_address,
			'sender_housenumber'             => $this->sender_housenumber,
			'sender_extra_info'              => $this->sender_extra_info,
			'sender_description'             => $this->sender_description,
			'sender_phone'                   => $this->sender_phone,
			'sender_email'                   => $this->sender_email,
			'sender_price'                   => $this->sender_price,
			'sender_currency'                => $this->sender_currency,
			'sender_creaditcard'             => $this->sender_creaditcard,
			'sender_date'                    => $this->sender_date,
			'recipient_name'                 => $this->recipient_name,
			'recipient_contactname'          => $this->recipient_contactname,
			'recipient_zipcode'              => $this->recipient_zipcode,
			'recipient_city'                 => $this->recipient_city,
			'recipient_address'              => $this->recipient_address,
			'recipient_housenumber'          => $this->recipient_housenumber,
			'recipient_extra_info'           => $this->recipient_extra_info,
			'recipient_description'          => $this->recipient_description,
			'recipient_phone'                => $this->recipient_phone,
			'recipient_email'                => $this->recipient_email,
			'recipient_price'                => $this->recipient_price,
			'recipient_currency'             => $this->recipient_currency,
			'recipient_creaditcard'          => $this->recipient_creaditcard,
			'recipient_date'                 => $this->recipient_date,
			'content'                        => $this->content,
			'foreign_identifier'             => $this->foreign_identifier ?? 0,
			'boxes'                          => $this->boxes,
			'weight'                         => $this->weight,
			'cost_declaration'               => $this->cost_declaration,
			'cost_declaration_currency'      => $this->cost_declaration_currency,
			'comment'                        => $this->comment,
			'content2'                       => $this->content2 ?? 0,
			'foreign_identifier2'            => $this->foreign_identifier2 ?? 0,
			'boxes2'                         => $this->boxes2 ?? 0,
			'weight2'                        => $this->weight2 ?? 0,
			'cost_declaration2'              => $this->cost_declaration2 ?? 0,
			'cost_declaration_currency2'     => $this->cost_declaration_currency2 ?? 0,
			'comment2'                       => $this->comment2 ?? 0,
			'payoutmode'                     => $this->payoutmode ?? 0,
			'banckaaccount_id'               => $this->banckaaccount_id ?? 0,
			'customer_foreign_identifier'    => $this->customer_foreign_identifier ?? 0,
			'extra_services'                 => $this->extra_services ?? null,
			'package_status'                 => $this->package_status ?? 1,
			'package_condition'              => $this->package_condition ?? 1
		);
	}
	/**
	 * @return string
	 */
	public function getBanckaaccountId(): string
	{
		return $this->banckaaccount_id;
	}

	/**
	 * @return int
	 */
	public function getBoxes(): int
	{
		return $this->boxes;
	}

	/**
	 * @return int
	 */
	public function getBoxes2(): int
	{
		return $this->boxes2;
	}

	/**
	 * @return string
	 */
	public function getComment(): string
	{
		return $this->comment;
	}

	/**
	 * @return string
	 */
	public function getComment2(): string
	{
		return $this->comment2;
	}

	/**
	 * @return string
	 */
	public function getCompanySite(): string
	{
		return $this->company_site;
	}

	/**
	 * @return string
	 */
	public function getContent(): string
	{
		return $this->content;
	}

	/**
	 * @return string
	 */
	public function getContent2(): string
	{
		return $this->content2;
	}

	/**
	 * @return int
	 */
	public function getCostDeclaration(): int
	{
		return $this->cost_declaration;
	}

	/**
	 * @return int
	 */
	public function getCostDeclaration2(): int
	{
		return $this->cost_declaration2;
	}

	/**
	 * @return int
	 */
	public function getCostDeclarationCurrency(): int
	{
		return $this->cost_declaration_currency;
	}

	/**
	 * @return int
	 */
	public function getCostDeclarationCurrency2(): int
	{
		return $this->cost_declaration_currency2;
	}

	/**
	 * @return string
	 */
	public function getCustomerForeignIdentifier(): string
	{
		return $this->customer_foreign_identifier;
	}

	/**
	 * @return mixed
	 */
	public function getExtraServices(): mixed
	{
		return $this->extra_services;
	}

	/**
	 * @return string
	 */
	public function getForeignIdentifier(): string
	{
		return $this->foreign_identifier;
	}

	/**
	 * @return string
	 */
	public function getForeignIdentifier2(): string
	{
		return $this->foreign_identifier2;
	}

	/**
	 * @return mixed
	 */
	public function getPackageCondition(): mixed
	{
		return $this->package_condition;
	}

	/**
	 * @return mixed
	 */
	public function getPackageStatus(): mixed
	{
		return $this->package_status;
	}

	/**
	 * @return int
	 */
	public function getPackageTypeId(): int
	{
		return $this->package_type_id;
	}

	/**
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}

	/**
	 * @return int
	 */
	public function getPayoutmode(): int
	{
		return $this->payoutmode;
	}

	/**
	 * @return string
	 */
	public function getRecipientAddress(): string
	{
		return $this->recipient_address;
	}

	/**
	 * @return string
	 */
	public function getRecipientCity(): string
	{
		return $this->recipient_city;
	}

	/**
	 * @return string
	 */
	public function getRecipientContactname(): string
	{
		return $this->recipient_contactname;
	}

	/**
	 * @return int
	 */
	public function getRecipientCreaditcard(): int
	{
		return $this->recipient_creaditcard;
	}

	/**
	 * @return int
	 */
	public function getRecipientCurrency(): int
	{
		return $this->recipient_currency;
	}

	/**
	 * @return mixed
	 */
	public function getRecipientDate(): mixed
	{
		return $this->recipient_date;
	}

	/**
	 * @return string
	 */
	public function getRecipientDescription(): string
	{
		return $this->recipient_description;
	}

	/**
	 * @return string
	 */
	public function getRecipientEmail(): string
	{
		return $this->recipient_email;
	}

	/**
	 * @return string
	 */
	public function getRecipientExtraInfo(): string
	{
		return $this->recipient_extra_info;
	}

	/**
	 * @return int
	 */
	public function getRecipientHousenumber(): int
	{
		return $this->recipient_housenumber;
	}

	/**
	 * @return string
	 */
	public function getRecipientName(): string
	{
		return $this->recipient_name;
	}

	/**
	 * @return string
	 */
	public function getRecipientPhone(): string
	{
		return $this->recipient_phone;
	}

	/**
	 * @return mixed
	 */
	public function getRecipientPrice(): mixed
	{
		return $this->recipient_price;
	}

	/**
	 * @return int
	 */
	public function getRecipientZipcode(): int
	{
		return $this->recipient_zipcode;
	}

	/**
	 * @return string
	 */
	public function getRecorder(): string
	{
		return $this->recorder;
	}

	/**
	 * @return string
	 */
	public function getSenderAddress(): string
	{
		return $this->sender_address;
	}

	/**
	 * @return string
	 */
	public function getSenderCity(): string
	{
		return $this->sender_city;
	}

	/**
	 * @return string|null
	 */
	public function getSenderContactname(): ?string
	{
		return $this->sender_contactname;
	}

	/**
	 * @return int
	 */
	public function getSenderCreaditcard(): int
	{
		return $this->sender_creaditcard;
	}

	/**
	 * @return int
	 */
	public function getSenderCurrency(): int
	{
		return $this->sender_currency;
	}

	/**
	 * @return mixed
	 */
	public function getSenderDate(): mixed
	{
		return $this->sender_date;
	}

	/**
	 * @return string
	 */
	public function getSenderDescription(): string
	{
		return $this->sender_description;
	}

	/**
	 * @return string
	 */
	public function getSenderEmail(): string
	{
		return $this->sender_email;
	}

	/**
	 * @return string
	 */
	public function getSenderExtraInfo(): string
	{
		return $this->sender_extra_info;
	}

	/**
	 * @return int
	 */
	public function getSenderHousenumber(): int
	{
		return $this->sender_housenumber;
	}

	/**
	 * @return string
	 */
	public function getSenderName(): string
	{
		return $this->sender_name;
	}

	/**
	 * @return string
	 */
	public function getSenderPhone(): string
	{
		return $this->sender_phone;
	}

	/**
	 * @return mixed
	 */
	public function getSenderPrice(): mixed
	{
		return $this->sender_price;
	}

	/**
	 * @return int
	 */
	public function getSenderZipcode(): int
	{
		return $this->sender_zipcode;
	}

	/**
	 * @return string
	 */
	public function getUsername(): string
	{
		return $this->username;
	}

	/**
	 * @return int
	 */
	public function getWeight(): int
	{
		return $this->weight;
	}

	/**
	 * @return int
	 */
	public function getWeight2(): int
	{
		return $this->weight2;
	}
	// </editor-fold>
	// <editor-fold desc="SETTER">
	/**
	 * @param int $weight
	 *
	 * @return KUMI
	 */
	public function setWeight(int $weight): KUMI
	{
		$this->weight = $weight;
		return $this;
	}

	/**
	 * @param string $username
	 *
	 * @return KUMI
	 */
	public function setUsername(string $username): KUMI
	{
		$this->username = $username;
		return $this;
	}

	/**
	 * @param string $password
	 *
	 * @return KUMI
	 */
	public function setPassword(string $password): KUMI
	{
		$this->password = $password;
		return $this;
	}

	/**
	 * @param string $banckaaccount_id
	 *
	 * @return KUMI
	 */
	public function setBanckaaccountId(string $banckaaccount_id): KUMI
	{
		$this->banckaaccount_id = $banckaaccount_id;
		return $this;
	}

	/**
	 * @param int $boxes
	 *
	 * @return KUMI
	 */
	public function setBoxes(int $boxes): KUMI
	{
		$this->boxes = $boxes;
		return $this;
	}

	/**
	 * @param int $boxes2
	 *
	 * @return KUMI
	 */
	public function setBoxes2(int $boxes2): KUMI
	{
		$this->boxes2 = $boxes2;
		return $this;
	}

	/**
	 * @param string $comment
	 *
	 * @return KUMI
	 */
	public function setComment(string $comment): KUMI
	{
		$this->comment = $comment;
		return $this;
	}

	/**
	 * @param string $comment2
	 *
	 * @return KUMI
	 */
	public function setComment2(string $comment2): KUMI
	{
		$this->comment2 = $comment2;
		return $this;
	}

	/**
	 * @param string $company_site
	 *
	 * @return KUMI
	 */
	public function setCompanySite(string $company_site): KUMI
	{
		$this->company_site = $company_site;
		return $this;
	}

	/**
	 * @param string $content
	 *
	 * @return KUMI
	 */
	public function setContent(string $content): KUMI
	{
		$this->content = $content;
		return $this;
	}

	/**
	 * @param string $content2
	 *
	 * @return KUMI
	 */
	public function setContent2(string $content2): KUMI
	{
		$this->content2 = $content2;
		return $this;
	}

	/**
	 * @param int $cost_declaration
	 *
	 * @return KUMI
	 */
	public function setCostDeclaration(int $cost_declaration): KUMI
	{
		$this->cost_declaration = $cost_declaration;
		return $this;
	}

	/**
	 * @param int $cost_declaration2
	 *
	 * @return KUMI
	 */
	public function setCostDeclaration2(int $cost_declaration2): KUMI
	{
		$this->cost_declaration2 = $cost_declaration2;
		return $this;
	}

	/**
	 * @param int $cost_declaration_currency
	 *
	 * @return KUMI
	 */
	public function setCostDeclarationCurrency(int $cost_declaration_currency): KUMI
	{
		$this->cost_declaration_currency = $cost_declaration_currency;
		return $this;
	}

	/**
	 * @param int $cost_declaration_currency2
	 *
	 * @return KUMI
	 */
	public function setCostDeclarationCurrency2(int $cost_declaration_currency2): KUMI
	{
		$this->cost_declaration_currency2 = $cost_declaration_currency2;
		return $this;
	}

	/**
	 * @param string $customer_foreign_identifier
	 *
	 * @return KUMI
	 */
	public function setCustomerForeignIdentifier(string $customer_foreign_identifier): KUMI
	{
		$this->customer_foreign_identifier = $customer_foreign_identifier;
		return $this;
	}

	/**
	 * @param mixed $extra_services
	 *
	 * @return KUMI
	 */
	public function setExtraServices(mixed $extra_services): KUMI
	{
		$this->extra_services = $extra_services;
		return $this;
	}

	/**
	 * @param string $foreign_identifier
	 *
	 * @return KUMI
	 */
	public function setForeignIdentifier(string $foreign_identifier): KUMI
	{
		$this->foreign_identifier = $foreign_identifier;
		return $this;
	}

	/**
	 * @param string $foreign_identifier2
	 *
	 * @return KUMI
	 */
	public function setForeignIdentifier2(string $foreign_identifier2): KUMI
	{
		$this->foreign_identifier2 = $foreign_identifier2;
		return $this;
	}

	/**
	 * @param mixed $package_condition
	 *
	 * @return KUMI
	 */
	public function setPackageCondition(mixed $package_condition): KUMI
	{
		$this->package_condition = $package_condition;
		return $this;
	}

	/**
	 * @param mixed $package_status
	 *
	 * @return KUMI
	 */
	public function setPackageStatus(mixed $package_status): KUMI
	{
		$this->package_status = $package_status;
		return $this;
	}

	/**
	 * @param int $package_type_id
	 *
	 * @return KUMI
	 */
	public function setPackageTypeId(int $package_type_id): KUMI
	{
		$this->package_type_id = $package_type_id;
		return $this;
	}

	/**
	 * @param int $payoutmode
	 *
	 * @return KUMI
	 */
	public function setPayoutmode(int $payoutmode): KUMI
	{
		$this->payoutmode = $payoutmode;
		return $this;
	}

	/**
	 * @param string $recipient_address
	 *
	 * @return KUMI
	 */
	public function setRecipientAddress(string $recipient_address): KUMI
	{
		$this->recipient_address = $recipient_address;
		return $this;
	}

	/**
	 * @param string $recipient_city
	 *
	 * @return KUMI
	 */
	public function setRecipientCity(string $recipient_city): KUMI
	{
		$this->recipient_city = $recipient_city;
		return $this;
	}

	/**
	 * @param string $recipient_contactname
	 *
	 * @return KUMI
	 */
	public function setRecipientContactname(string $recipient_contactname): KUMI
	{
		$this->recipient_contactname = $recipient_contactname;
		return $this;
	}

	/**
	 * @param int $recipient_creaditcard
	 *
	 * @return KUMI
	 */
	public function setRecipientCreaditcard(int $recipient_creaditcard): KUMI
	{
		$this->recipient_creaditcard = $recipient_creaditcard;
		return $this;
	}

	/**
	 * @param int $recipient_currency
	 *
	 * @return KUMI
	 */
	public function setRecipientCurrency(int $recipient_currency): KUMI
	{
		$this->recipient_currency = $recipient_currency;
		return $this;
	}

	/**
	 * @param mixed $recipient_date
	 *
	 * @return KUMI
	 */
	public function setRecipientDate(mixed $recipient_date): KUMI
	{
		$this->recipient_date = $recipient_date;
		return $this;
	}

	/**
	 * @param string $recipient_description
	 *
	 * @return KUMI
	 */
	public function setRecipientDescription(string $recipient_description): KUMI
	{
		$this->recipient_description = $recipient_description;
		return $this;
	}

	/**
	 * @param string $recipient_email
	 *
	 * @return KUMI
	 */
	public function setRecipientEmail(string $recipient_email): KUMI
	{
		$this->recipient_email = $recipient_email;
		return $this;
	}

	/**
	 * @param string $recipient_extra_info
	 *
	 * @return KUMI
	 */
	public function setRecipientExtraInfo(string $recipient_extra_info): KUMI
	{
		$this->recipient_extra_info = $recipient_extra_info;
		return $this;
	}

	/**
	 * @param int $recipient_housenumber
	 *
	 * @return KUMI
	 */
	public function setRecipientHousenumber(int $recipient_housenumber): KUMI
	{
		$this->recipient_housenumber = $recipient_housenumber;
		return $this;
	}

	/**
	 * @param string $recipient_name
	 *
	 * @return KUMI
	 */
	public function setRecipientName(string $recipient_name): KUMI
	{
		$this->recipient_name = $recipient_name;
		return $this;
	}

	/**
	 * @param string $recipient_phone
	 *
	 * @return KUMI
	 */
	public function setRecipientPhone(string $recipient_phone): KUMI
	{
		$this->recipient_phone = $recipient_phone;
		return $this;
	}

	/**
	 * @param mixed $recipient_price
	 *
	 * @return KUMI
	 */
	public function setRecipientPrice(mixed $recipient_price): KUMI
	{
		$this->recipient_price = $recipient_price;
		return $this;
	}

	/**
	 * @param int $recipient_zipcode
	 *
	 * @return KUMI
	 */
	public function setRecipientZipcode(int $recipient_zipcode): KUMI
	{
		$this->recipient_zipcode = $recipient_zipcode;
		return $this;
	}

	/**
	 * @param string $recorder
	 *
	 * @return KUMI
	 */
	public function setRecorder(string $recorder): KUMI
	{
		$this->recorder = $recorder;
		return $this;
	}

	/**
	 * @param string $sender_address
	 *
	 * @return KUMI
	 */
	public function setSenderAddress(string $sender_address): KUMI
	{
		$this->sender_address = $sender_address;
		return $this;
	}

	/**
	 * @param string $sender_city
	 *
	 * @return KUMI
	 */
	public function setSenderCity(string $sender_city): KUMI
	{
		$this->sender_city = $sender_city;
		return $this;
	}

	/**
	 * @param string|null $sender_contactname
	 *
	 * @return KUMI
	 */
	public function setSenderContactname(?string $sender_contactname): KUMI
	{
		$this->sender_contactname = $sender_contactname;
		return $this;
	}

	/**
	 * @param int $sender_creaditcard
	 *
	 * @return KUMI
	 */
	public function setSenderCreaditcard(int $sender_creaditcard): KUMI
	{
		$this->sender_creaditcard = $sender_creaditcard;
		return $this;
	}

	/**
	 * @param int $sender_currency
	 *
	 * @return KUMI
	 */
	public function setSenderCurrency(int $sender_currency): KUMI
	{
		$this->sender_currency = $sender_currency;
		return $this;
	}

	/**
	 * @param mixed $sender_date
	 *
	 * @return KUMI
	 */
	public function setSenderDate(mixed $sender_date): KUMI
	{
		$this->sender_date = $sender_date;
		return $this;
	}

	/**
	 * @param string $sender_description
	 *
	 * @return KUMI
	 */
	public function setSenderDescription(string $sender_description): KUMI
	{
		$this->sender_description = $sender_description;
		return $this;
	}

	/**
	 * @param string $sender_email
	 *
	 * @return KUMI
	 */
	public function setSenderEmail(string $sender_email): KUMI
	{
		$this->sender_email = $sender_email;
		return $this;
	}

	/**
	 * @param string $sender_extra_info
	 *
	 * @return KUMI
	 */
	public function setSenderExtraInfo(string $sender_extra_info): KUMI
	{
		$this->sender_extra_info = $sender_extra_info;
		return $this;
	}

	/**
	 * @param int $sender_housenumber
	 *
	 * @return KUMI
	 */
	public function setSenderHousenumber(int $sender_housenumber): KUMI
	{
		$this->sender_housenumber = $sender_housenumber;
		return $this;
	}

	/**
	 * @param string $sender_name
	 *
	 * @return KUMI
	 */
	public function setSenderName(string $sender_name): KUMI
	{
		$this->sender_name = $sender_name;
		return $this;
	}

	/**
	 * @param string $sender_phone
	 *
	 * @return KUMI
	 */
	public function setSenderPhone(string $sender_phone): KUMI
	{
		$this->sender_phone = $sender_phone;
		return $this;
	}

	/**
	 * @param mixed $sender_price
	 *
	 * @return KUMI
	 */
	public function setSenderPrice(mixed $sender_price): KUMI
	{
		$this->sender_price = $sender_price;
		return $this;
	}

	/**
	 * @param int $sender_zipcode
	 *
	 * @return KUMI
	 */
	public function setSenderZipcode(int $sender_zipcode): KUMI
	{
		$this->sender_zipcode = $sender_zipcode;
		return $this;
	}

	/**
	 * @param int $weight2
	 *
	 * @return KUMI
	 */
	public function setWeight2(int $weight2): KUMI
	{
		$this->weight2 = $weight2;
		return $this;
	}
	// </editor-fold>
}
class KUMIResult
{
	/**
	 * @var bool
	 */
	private bool $successfull;
	/**
	 * @var \KUMI\KUMIError
	 */
	private KUMIError $error;
	/**
	 * @var KUMIPackage[]
	 */
	private array $package;

	/**
	 * @return KUMIPackage[]
	 */
	public function getPackage(): array
	{
		return $this->package;
	}

	/**
	 * @return KUMIError
	 */
	public function getError(): KUMIError
	{
		return $this->error;
	}

	/**
	 * @return bool
	 */
	public function isSuccessfull(): bool
	{
		return $this->successfull;
	}

	/**
	 * @param KUMIError $error
	 *
	 * @return $this
	 */
	public function setError(KUMIError $error): self
	{
		$this->error = $error;
		return $this;
	}

	/**
	 * @param array $package
	 *
	 * @return KUMIResult
	 */
	public function setPackage(array $package): KUMIResult
	{
		$this->package = $package;
		return $this;
	}

	/**
	 * @param bool $successfull
	 *
	 * @return KUMIResult
	 */
	public function setSuccessfull(bool $successfull): KUMIResult
	{
		$this->successfull = $successfull;
		return $this;
	}
}
class KUMIPackage
{
	private string $packagenumber;
	private string $customer_foreign_identifier;
	private string $showable_packagenumber;
	private string $followlink;
	private string $securecode;

	/**
	 * @return string
	 */
	public function getShowablePackagenumber(): string
	{
		return $this->showable_packagenumber;
	}

	/**
	 * @return string
	 */
	public function getSecurecode(): string
	{
		return $this->securecode;
	}

	/**
	 * @return string
	 */
	public function getPackagenumber(): string
	{
		return $this->packagenumber;
	}

	/**
	 * @return string
	 */
	public function getFollowlink(): string
	{
		return $this->followlink;
	}

	/**
	 * @return string
	 */
	public function getCustomerForeignIdentifier(): string
	{
		return $this->customer_foreign_identifier;
	}

	/**
	 * @param string $customer_foreign_identifier
	 *
	 * @return KUMIPackage
	 */
	public function setCustomerForeignIdentifier(string $customer_foreign_identifier): KUMIPackage
	{
		$this->customer_foreign_identifier = $customer_foreign_identifier;
		return $this;
	}

	/**
	 * @param string $followlink
	 *
	 * @return KUMIPackage
	 */
	public function setFollowlink(string $followlink): KUMIPackage
	{
		$this->followlink = $followlink;
		return $this;
	}

	/**
	 * @param string $packagenumber
	 *
	 * @return KUMIPackage
	 */
	public function setPackagenumber(string $packagenumber): KUMIPackage
	{
		$this->packagenumber = $packagenumber;
		return $this;
	}

	/**
	 * @param string $securecode
	 *
	 * @return KUMIPackage
	 */
	public function setSecurecode(string $securecode): KUMIPackage
	{
		$this->securecode = $securecode;
		return $this;
	}

	/**
	 * @param string $showable_packagenumber
	 *
	 * @return KUMIPackage
	 */
	public function setShowablePackagenumber(string $showable_packagenumber): KUMIPackage
	{
		$this->showable_packagenumber = $showable_packagenumber;
		return $this;
	}
}
class KUMIError
{
	private mixed $code;
	private ?string $description;

	/**
	 * @param mixed $code
	 *
	 * @return KUMIError
	 */
	public function setCode(mixed $code):KUMIError
	{
		$this->code = $code;
		return $this;
	}

	/**
	 * @param string $description
	 *
	 * @return KUMIError
	 */
	public function setDescription(?string $description):KUMIError
	{
		$this->description = $description;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCode():mixed
	{
		return $this->code;
	}

	/**
	 * @return string
	 */
	public function getDescription():?string
	{
		return $this->description;
	}
}
