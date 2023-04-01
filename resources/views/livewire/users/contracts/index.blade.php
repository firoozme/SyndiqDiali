<div>
    <h4 class="text-underline font-italic font-weight-bold text-center">CONTRACT </h4>
    <h5 class="text-underline font-italic font-weight-bold text-center mt-3">CONTRAT DE SYNDIC CONFORME A LA LOI 18.00 DU
        DAHIR N° 1-02-298 DU 3 OCTOBRE 2002 PORTANT
        PROMULGATION DE LA LOI N°18-00 RELATIVE AU STATUT DE LA COPROPRIETE DES IMMEUBLES BÂTIS</h5>
    <h6 class="text-underline font-italic font-weight-bold mt-5">ENTRE</h6>
    <p>Le syndicat des copropriétaires de la résidence<span class="font-weight-bold"> {{ $syndicate->name ?? null }}
        </span> sise à SYNDICAT_ADDRESS, représenté par son
        président <span class="font-weight-bold"> M. {{ $president->name ?? null }} </span> et son vice-président <span
            class="font-weight-bold">M. {{ $visePresident->name ?? null }}</span>;
        Ci-après appelé « le Syndicat » ;</p>
    <h6 class="text-underline font-italic font-weight-bold mt-5">D’une part. ET</h6>
    <p>La société <span class="font-weight-bold"> SYNDIC DIALI SARL </span> au capital de 100.000,00 DHS, inscrite au
        registre de commerce de NADOR sous le
        numéro 22187, dont le siège social est à : <span class="font-weight-bold">RUE ABDELKHALEK TORRES N°21
            NADOR</span>, représentée par son gérant <span class="font-weight-bold">M.
            Belaziz BELHADI </span>;
        <span class="font-weight-bold">Ci-après appelée «la Société » ;</span>
    </p>
    <h6 class="text-underline font-italic font-weight-bold mt-5">D’autre part</h6>
    <p>Par la présente, et après un vote favorable de l’assemblée générale des copropriétaires de la résidence <span
            class="font-weight-bold"> {{ $syndicate->name ?? null }} </span>
        en date du SYNDICAT_CREATION_DATE, le Syndicat des copropriétaires, donne mandat à la Société <span
            class="font-weight-bold"> SYNDIC DIALI </span>
        SARL qui l’accepte, pour exercer la mission de syndic de l’immeuble ci-dessus indiqué, dans le cadre de la loi
        N°18-00 du 3
        octobre 2002 relative au statut de la copropriété des immeubles bâtis</p>

    <h6 class="text-underline font-italic font-weight-bold mt-5"> Article 1 : LES MISSIONS LEGALES DU SYNDIC A EXERCER :
    </h6>
    <p>Conformément à l’article 26 de la loi 18.00 le syndic est chargé des missions suivantes :</p>
    <ul class="contract">
        <li>D’exécuter les dispositions du règlement de copropriété dont il est assigné ;</li>
        <li>De concrétiser les décisions de l’assemblée générale, à moins qu’elles ne soient contées au conseil
            syndical, aux propriétaires ou aux tiers ;</li>
        <li>De veiller au bon usage des parties communes en assurant leur entretien, la garde des principales entrées de
            l’immeuble et les équipements communs (suivant le budget voté) ;</li>
        <li>D’effectuer les réparations urgentes même d’office (suivant le budget voté) ;</li>
        <li>De préparer le projet du budget du syndicat en vue de son examen et de son approbation par l'assemblée
            générale ;
        </li>
        <li>De collecter les participations des copropriétaires aux charges contre récépissé ;</li>
        <li>De délivrer un récépissé aux copropriétaires en cas de vente s'il n'est pas débiteur à l'égard du syndicat ;
        </li>
        <li>D’établir de manière régulière le budget du syndicat et la tenue d’une comptabilité faisant apparaître la
            situation de
            trésorerie de syndicat et de chaque copropriétaire ;
        </li>
        <li>De communiquer la situation de la trésorerie du syndicat aux copropriétaires, au moins tous les trois mois ;
        </li>
        <li>De tenir les archives et les registres relatifs à la résidence et au syndicat et faciliter à tous les
            copropriétaires l’accès
            à ces documents notamment avant la tenue de l’assemblée général dont l’ordre du jour porte sur l’examen de
            la
            comptabilité du syndicat ;</li>
        <li>D’entreprendre des démarches administratives qui lui sont reconnues et celles qui lui sont déléguées ;</li>
        <li>De représenter le syndicat en justice sur ordre spécial de l’assemblée générale.</li>
    </ul>

    <h6 class="text-underline font-italic font-weight-bold mt-5">  Article 2 : LES MANDATS DU SYNDICAT A LA SOCIETE :  </h6>
    <ul class="contract">
        <li>Déléguer les missions légales du Syndic tel que détaillées ci-dessus ;</li>
        <li>De gérer en qualité de mandataire du syndicat des copropriétaires le compte bancaire et une caisse de fonds
            (1.000,00 DH) en espèces dans les limites du budget prévisionnel voté et des dispositions de la loi ;</li>
        <li>De souscrire des contrats de prestations de services auprès des sociétés spécialisées (suivant le budget voté) ;</li>
        <li>De souscrire auprès des fournisseurs d’eau et d’électricité les abonnements nécessaires au nom du syndicat des
            copropriétaires de la résidence <span class="font-weight-bold"> {{ $syndicate->name ?? null }} </span> (suivant le budget voté) ;</li>
        <li>D’établir un règlement intérieur et de le mettre en application après sa validation par le conseil syndical ;</li>
        <li>De suivre les levées des réserves techniques découlant de l’état des lieux contradictoire des parties communes établi
            avec la Direction Technique du promoteur</li>
    </ul>

    <h6 class="text-underline font-italic font-weight-bold mt-5"> Article 3 : MISSIONS CONTRACTUELLES DE LA SOCIETE : </h6>
    <ul class="contract">
        <li>La société s’engage à organiser des visites régulières de la copropriété « résidence <span class="font-weight-bold"> {{ $syndicate->name ?? null }} </span> afin de
            s’assurer du bon fonctionnement des éléments d’équipements communs (portes, escaliers, … etc.) et du bon
            entretien des parties communes (suivant le budget voté) ;</li>
        <li>Les bureaux de la Société sont ouverts du lundi au vendredi de 08h00 à 12h00 et de 14h30 à 18h30. Le samedi de
            08h30 à 12h00 ;</li>
        <li>En dehors de ces horaires, la Société assure une astreinte pour les urgences ;</li>
        <li>A la demande du Syndic et/ou des copropriétaires, la Société organise régulièrement ou exceptionnellement des
            réunions des membres du conseil du syndicat ;</li>
        <li>La Société s’engage de charger, sur son entière responsabilité, un agent qui se chargera du gardiennage, de la
            surveillance et de l’entretien de la copropriété et ses équipements, contre un salaire mensuel de 2.500,00 DH (Deux
            mille cinq cent Dirhams) qui sera servi directement par la Société. Ladite somme sera ensuite réglée par le Syndicat
            suivant le budget voté.</li>
    </ul>

    <h6 class="text-underline font-italic font-weight-bold mt-5"> Article 4 : LES HONORAIRES DE LA SOCIETE </h6>
    <p>En rémunération des prestations définies ci-haut, les honoraires de la société sont fixés à la somme de 2.000,00 dirhams
        (Deux Mille Dirhams) par mois (suivant le budget voté ci-joint), hors le salaire de l’agent du gardiennage et de la
        surveillance.</p>
    <h6 class="text-underline font-italic font-weight-bold mt-5"> Article 5 : FIN DE MISSION</h6>
    <p>A l’expiration de sa mission, la Société gestionnaire s’oblige, dans un délai maximum de 15 jours à partir de la nomination
        du nouveau syndic gestionnaire, à remettre à celui-ci tous les documents, archives, registres du Syndicat et de la résidence, la
        situation de trésorerie et tous les biens du Syndicat y compris les liquidités.</p>
    <h6 class="text-underline font-italic font-weight-bold mt-5"> Article 6 : ELECTION DE DOMICILE </h6>
    <p>Pour l’exécution du présent contrat, les parties font élection de domicile :</p>
    <ul class="contract">
        <li>Pour le syndicat des copropriétaires : la copropriété « résidence <span class="font-weight-bold"> {{ $syndicate->name ?? null }} </span>.</li>
        <li>Pour la société SYNDIC DIALI : le siège social</li>
    </ul>

    <h6 class="text-underline font-italic font-weight-bold mt-5">Article 7 : DUREE ET DATE D’EFFET DU CONTRAT </h6>
    <p>La durée du présent contrat est de 2 ans, renouvelable par tacite reconduction.
        La date d’effet est à compter du 01/08/2022</p>
    <h6 class="text-underline font-italic font-weight-bold mt-5"> Article 8 : LITIGES </h6>
    <p>Tous litiges seront réglés à l’amiable.
        En cas de désaccord, ils seront soumis aux tribunaux compétents de NADOR.</p>

    <h6 class="text-underline font-italic font-weight-bold mt-5"> Article 9 : RESILIATION DU CONTRAT </h6>
    <p>Le présent contrat pourra être résilié à la demande de l’une des deux parties par simple lettre recommandée avec accusé de
        réception portant préavis de trois (3) mois.</p>
    <h6 class="text-underline font-italic font-weight-bold mt-5"> Article 10 : RÉVISION </h6>
    <p>L’ensemble des prix ou montants indiqués dans le présent contrat sera révisé annuellement en fonction de l’indice national du
        coût de la construction.</p>
    <p class="text-center mt-5">Fait à NADOR, en (3) Exemplaires originaux, le <span> {{ $syndicate->syndicate_creation_date ?? null }} </span> </p>
    <h6 class="text-center text-underline font-italic font-weight-bold mt-5">SIGNATURES </h6>

    <div class="row">
        <div class="col">
            <h6 class="text-underline font-italic font-weight-bold mt-5">Pour le Syndicat </h6>
            <div>M. {{ $president->name ?? null }}</div>
            <div>M. {{ $visePresident->name ?? null }}</div>
        </div>
        <div class="col">
            <h6 class="text-underline font-italic font-weight-bold mt-5">Pour La Société (le Syndic) </h6>
            <div>M. Belaziz BELHADI</div>
        </div>
    </div>


</div>

