<x-mail::message>
    # Agradecemos pela sua Preferência!

    Olá {{ $data['user_name'] }},

    A equipe da HSS Rental agradece pela sua preferência em escolher nossos serviços de locação de veículos. Estamos empolgados em fornecer a você uma experiência excepcional durante o período de locação.

    Detalhes da Reserva

    - Veículo: {{ $data['brand_car'] }}
    - Modelo: {{ $data['model_car'] }}
    - Ano: {{ $data['year_car'] }}
    - Placa: {{ $data['plate_car'] }}
    - Data de Retirada: {{ $data['start_reservation_date'] }}
    - Data de Devolução: {{ $data['end_reservation_date'] }}

    Opções de Seguro

    Oferecemos diversas opções de seguro para garantir sua tranquilidade durante a locação. Por favor, reveja as opções abaixo e informe-nos sobre sua escolha:

    1. Seguro Básico: Incluído na tarifa, cobre danos ao veículo.
    2. Seguro contra Terceiros: Oferece cobertura em caso de danos a terceiros.
    3. Proteção contra Roubo: Cobertura em caso de roubo do veículo.

    Por favor, responda a este e-mail indicando sua escolha de seguro.


    Agradecemos novamente por escolher a HSS Rental. Estamos ansiosos para atendê-lo e proporcionar uma experiência de locação excepcional.

    Obrigado,

    {{ config('app.name') }}
</x-mail::message>
