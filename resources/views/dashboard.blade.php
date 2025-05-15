<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'E-Commerce')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<div class="py-12">
    <body class="bg-gray-100 min-h-screen flex flex-col">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Welcome, {{ Auth::user()->name }}!</h1>
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <div class="mb-8 text-gray-700">You're logged in!</div>
            <form method="POST" action="{{ route('logout') }}" class="mb-8">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Logout</button>
            </form>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ([
                    [
                        'img' => 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAFwAXAMBIgACEQEDEQH/xAAcAAACAgMBAQAAAAAAAAAAAAAFBwMGAAQIAgH/xABGEAABAwMBBAUGCgYLAQAAAAABAgMEAAURBgcSITETQVFzsRQkNHGy0SIzU2FygZGSlKEXMjZiZKIWIyY1N0JSVXSzwRX/xAAZAQADAQEBAAAAAAAAAAAAAAABAgQDBQD/xAAhEQADAAEEAgMBAAAAAAAAAAAAAQIRAwQSITEyE0FRIv/aAAwDAQACEQMRAD8AeNVbUuoLdYLS5eL2470Jc3GWmycqPHdSkZGSQCeNWmqNrvTkLUmkBHuExEFMdfTokrUAltQyMqz1YJFBhRPovVNj1jHfctrb7TscgOsPkhaM8jwJGDg9dWMRI5GQkkfTV76o2yXStuscSVOg3Zi6OSsIcfjrCkfBzwGOXM1f0JSgbqRgUrCiB2NHbbWvoyd1JON9Xvrmq+7Q9SyrrJXAuLkWMHFJabbSOCQeGSQTmumZXoz3dq8K5FJbDq8pJO8fGg6wNM5YROu9X/75K+xPurwdf6uTnN9lfNwT7qgbEdXBSFCvS7Wh8HoSCezrpPmS8mnw/h7/AEg6uz/fsn+X3V6RtE1ehYUL7JyO0JP/AJVstWitKNQbU3qB64sypsNU8ykOIQwAknLA3v8ANj8yPVVa13ZbTCt9jvNiYlxIt2ZdX5JLVvLb3FBOQf8ASrORWyeTBrHR0Psz1E/qfSUS4y0gSDvIc3eRKTjP5VaqXOwX/D6N3zvtmmNRAZS32l6euepdDR41pO++08l9TGcdOAFDd7OZB48OFMilntTn3q26BacsanW1F4IkvMZ322vhZII4jjgZHbQfkKNTYrpW76eFyk3VoxUStwIjZzukZ4nqzx6qZ9KnYVdL7OYuLV0ekyYKN0xnpKipWTneAJ4kcqa1K/IyIpXoz3dq8K5WjwukJOOZJ/OuqZXor3dq8K5ztjAUy2ccwKn3FcZ6KNuk67NBFrJHKpU21xGCkVZ48YEDhW83BSeoVznq0dDhOCYWayTLDZ4F1YXibHWWroXyfJpBUco3OW6DjPbnPzii7R9PPad0/peLOZ3JwTMQ9hwrSUh7KN3jgDCs8Mc+PGm1F09A8ngTnI6FRI7C3ZBK/jXc8EEfZ6xVL2t2lp60Wy5IiNxZK2VqdaZ/UCd4bpA6sjj9Rq7R1cdUc3UlU+i67BT/AGCYHV0rntqpj0uNgwI0Gx2dK4P51Ux6uJjKGQgl2A2FpCkqByk8RzNE6G28AQ2wOrPiaWgolZZaYTusNobT2JGKkzXyspRiOUfNXu7V4UgrMjMVk/uin3L9Fe7tXhSOsKMwo/0BUu79EUbb2YYis5xwooyxwHCoobQwKKMt8BXPU5LXXRNBtvlSFBDjYcB4NrVgq9VAtXWpxFufaktKTwGAocMZwcfUTVugNBMdx7yUPqQR+seCR2kddamp7jOhW5xcgMrbdbI8ndbBTjkMjq51u9KVKr7JKt8jU2EZToVpCuaX3c/fVTFpe7DwP6FhQzxkvf8AYqmFXWXgjZlDIJ81R9fiaJ0KgnzVHrPiaFHkbOazNec1maQYjlnzV7u1eBpKae9Ajd2nwp1Sz5o93avCkrp8jyCN3afCpd36I30PZlpichRRnlQqKocONEW3ABUUtFFMO2pLqW3HYzQU8OG8pYASPVVR2pyVxYLa3muhfeSrewsKCsYwR2c/yqxRT08J2OsPNdIpK0OhlSknHUcCldtbuaMW22tIkkRkO70l6OtoPFSgcI3gCQnt/eqyVzlIlb/rIwdhZzoZB/iXvbNMOlzsGOdBtH+Id9o0xqvROZQiD6Kj1q8TReg8H0VHrV4mhQUbFZmvh4ivG4nOcfnSDHyWfNH+7V4UhbNNS3FZSTyQBT2lISIr5A49GrwNcvsSyn4IVyJFY68c5wa6LSrsZce6NgDKxXt+/MspOVjPYKXiZxCeKj9ta0q4cD8KoltW2Uu5GnD1ghjS9wulw/8AoOx48luMw3GmrZ+EoZwcHgMdf1VS9qM6PdLTpu8QhPTHmtSMJmzFvqSpC0pUBvE4HDmOfXyoxs9g3GLItKH50MRNR9KFW2TH6ffaabUtLqkkgfrJwPmIPHqrG1NVwfn2+c9OizbRJjZtbkRnoWktg4UgN80qB5gk9XqHT044zgiqk66HBsE/YFrv3faNMelvsD/YFr/kOe0aZFamZlBYJ82A60qWk/MQog0aPKhNyjCOVPx3FtlasqQMFJPbxHA+qhSyFElZQ0uv4+PX91Pur6h185/r1/dT7qTA2Tcl+iP4+TV4VyQ66WX3ULGFIcUkg9RBrqovP5+PV91Puqm3PZxpy6z3JUlh5Lrh3llpzcBPqHCikezgQipZ6jUC3irmafP6JdLfJzPxBr0nZHpU825n4g+6jgHIoNuvlivNmtDV1vk7Tt4szRjszozK3EvMnOB8A7yVAEjs4nnngF1xerXNj2izafS+bVaGloaekDC3lrVvLXjqBPIU1v0SaV+Sl/iDUrGyLShfQlTMspJ4jyg0woT2CJUnQDJUCMvuYz9KmPWpa7dFtUFqFAZS1HZTuoQnqFbdePH/2Q==',
                        'title' => 'Смартфон Samsung Galaxy S23',
                        'desc' => '6.1" AMOLED, 128 ГБ, 50 Мп, 5G',
                        'price' => '299 990 ₸'
                    ],
                    [
                        'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0GgKGylS8g2sMOQYbIqat-_80N6HkWrF9Gw&s',
                        'title' => 'Ноутбук Apple MacBook Air M2',
                        'desc' => '13.6" Retina, 8 ГБ, 256 ГБ SSD',
                        'price' => '599 990 ₸'
                    ],
                ] as $product)
                <div class="border border-gray-200 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 bg-white flex flex-col overflow-hidden">
                    <div class="h-48 w-full bg-gray-100 flex items-center justify-center overflow-hidden">
                        <img src="{{ $product['img'] }}" alt="{{ $product['title'] }}" class="object-contain h-44 w-full transition-transform duration-300 hover:scale-105">
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <h2 class="font-semibold text-lg mb-2 text-gray-900">{{ $product['title'] }}</h2>
                        <p class="text-gray-600 mb-4 flex-1">{{ $product['desc'] }}</p>
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-xl font-bold text-indigo-600">{{ $product['price'] }}</span>
                            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-semibold shadow transition">В корзину</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </body>
</div>
</html>
