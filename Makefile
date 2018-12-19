all:
	if [[ -e joomshopping-begateway.zip ]]; then rm joomshopping-begateway.zip; fi
	cd plg_begateway && zip -r ../joomshopping-begateway.zip * -x "*/test/*" -x "*/.git/*" -x "*/examples/*"
