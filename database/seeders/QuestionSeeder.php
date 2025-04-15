<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Filipino Exam Question
         */

        Question::create([
            'exam_id' => 1,
            'question' => 'Ito ay isang tulang pasalaysay na patungkol sa kabayanihan ng pangunahing tauhan.',
            'question_file' => null,
            'a' => 'Pabula',
            'a_file' => null,
            'b' => 'Mitolohiya',
            'b_file' => null,
            'c' => 'Epiko',
            'c_file' => null,
            'd' => 'Parabula',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 1,
            'question' => 'Ito ay mga kuwento na hango sa Bibliya na kapupulutan ng aral sa buhay.',
            'question_file' => null,
            'a' => 'Pabula',
            'a_file' => null,
            'b' => 'Mitolohiya',
            'b_file' => null,
            'c' => 'Epiko',
            'c_file' => null,
            'd' => 'Parabula',
            'd_file' => null,
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 1,
            'question' => 'Ayon kay Hesus, ilang beses dapat patawarin ang taong nanakit sa iyo.',
            'question_file' => null,
            'a' => 'Tatlo',
            'a_file' => null,
            'b' => 'Pitumpu\'t Pito',
            'b_file' => null,
            'c' => 'Lima',
            'c_file' => null,
            'd' => 'Pito ng Pitumpu',
            'd_file' => null,
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 1,
            'question' => 'Tukuyin ang aspekto ng pandiwa sa bawat pangungusap.',
            'question_file' => null,
            'a' => 'Imperpektibo',
            'a_file' => null,
            'b' => 'Kontemplatibo',
            'b_file' => null,
            'c' => 'Perpektibo',
            'c_file' => null,
            'd' => 'Pawatas',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 1,
            'question' => 'Ito ay bahagi ng pananalita na nag-uugnay sa mga salita, parirala at pangungusap.',
            'question_file' => null,
            'a' => 'Pandiwa',
            'a_file' => null,
            'b' => 'Pang-uri',
            'b_file' => null,
            'c' => 'Pangatnig',
            'c_file' => null,
            'd' => 'Panghalip',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 1,
            'question' => 'Katangian ni Pandora na  nagtulak sa kanya upang buksan ang kahon.',
            'question_file' => null,
            'a' => 'Mapagbalat-kayo',
            'a_file' => null,
            'b' => 'masunurin',
            'b_file' => null,
            'c' => 'mausisa',
            'c_file' => null,
            'd' => 'matalino',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 1,
            'question' => 'Ito ay pagpupulong na dinadaluhan ng iba\'t ibang mga tagapagsalita na may kaalaman sa partikular na paksa.',
            'question_file' => null,
            'a' => 'Palihan',
            'a_file' => null,
            'b' => 'Simposyum',
            'b_file' => null,
            'c' => 'Pulong',
            'c_file' => null,
            'd' => 'Debate',
            'd_file' => null,
            'correct_answer' => 'b'
        ]);

        Question::create([
            'exam_id' => 1,
            'question' => 'Nilikhang nilalang ni Epimetheus.',
            'question_file' => null,
            'a' => 'Hayop',
            'a_file' => null,
            'b' => 'Tao',
            'b_file' => null,
            'c' => 'Halaman',
            'c_file' => null,
            'd' => 'Karagatan',
            'd_file' => null,
            'correct_answer' => 'a'
        ]);

        Question::create([
            'exam_id' => 1,
            'question' => 'Ito ay isang panitikang nahahati sa ilang kabanata.',
            'question_file' => null,
            'a' => 'Mitolohiya',
            'a_file' => null,
            'b' => 'Parabola',
            'b_file' => null,
            'c' => 'Nobela',
            'c_file' => null,
            'd' => 'Epiko',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 1,
            'question' => 'Ang nagbigay ng apoy sa mga tao.',
            'question_file' => null,
            'a' => 'Epimetheus',
            'a_file' => null,
            'b' => 'Promitheus',
            'b_file' => null,
            'c' => 'Zeus',
            'c_file' => null,
            'd' => 'Pandora',
            'd_file' => null,
            'correct_answer' => 'b'
        ]);

        /**
         * Science Exam Question
         */

         Question::create([
            'exam_id' => 2,
            'question' => 'The idea propsed by Alfred Wegener to explain the continental shapes and positions is known as ____?',
            'question_file' => null,
            'a' => 'Pangaea',
            'a_file' => null,
            'b' => 'Elastic Rebound',
            'b_file' => null,
            'c' => 'Plate tectonics',
            'c_file' => null,
            'd' => 'Continental Drift',
            'd_file' => null,
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'The Philippines is home for many active and inactive volcanoes. Last January 12, 2020, one of the active volcano in Batangas erupted, what was the name of this volcano?',
            'question_file' => null,
            'a' => 'Hibok-hibok',
            'a_file' => null,
            'b' => 'Iraya',
            'b_file' => null,
            'c' => 'Mayon',
            'c_file' => null,
            'd' => 'Taal',
            'd_file' => null,
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'Where are volcanoes mostly loated on the map?',
            'question_file' => null,
            'a' => 'Oceans',
            'a_file' => null,
            'b' => 'Edge of cotinents',
            'b_file' => null,
            'c' => 'mind-continents',
            'c_file' => null,
            'd' => 'none of the above',
            'd_file' => null,
            'correct_answer' => 'b'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'The supercontinent called Pangaea was believed to exist ___ million years ago.',
            'question_file' => null,
            'a' => '150',
            'a_file' => null,
            'b' => '100',
            'b_file' => null,
            'c' => '225',
            'c_file' => null,
            'd' => '300',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'The Earth\'s crust is the upper layer of the lithosphere. What could you expect to find there?',
            'question_file' => null,
            'a' => 'mantle and core',
            'a_file' => null,
            'b' => 'variety of solid rocks',
            'b_file' => null,
            'c' => 'layers of the atmosphere',
            'c_file' => null,
            'd' => 'variety of gaseous particles',
            'd_file' => null,
            'correct_answer' => 'b'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'What makes up the Earth\'s lithosphere?',
            'question_file' => null,
            'a' => 'crust and core',
            'a_file' => null,
            'b' => 'cusrt and lower mantle',
            'b_file' => null,
            'c' => 'crust and upper mantle',
            'c_file' => null,
            'd' => 'oceanic and continental crust',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'What is the strongest earthquake that hits the Philippines during 1976?',
            'question_file' => null,
            'a' => 'Bohol Earthquake',
            'a_file' => null,
            'b' => 'Ragay Gulf',
            'b_file' => null,
            'c' => 'Moro Gulf',
            'c_file' => null,
            'd' => 'Casiguran Earthquake',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'The following belongs to the major playes of the Earth EXCEPT?',
            'question_file' => null,
            'a' => 'Indo-Australian',
            'a_file' => null,
            'b' => 'Eurasian',
            'b_file' => null,
            'c' => 'Cocos',
            'c_file' => null,
            'd' => 'Antartic Plate',
            'd_file' => null,
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'All of these are wise practices during an earthquakre EXCEPT ____',
            'question_file' => null,
            'a' => 'cover your head',
            'a_file' => null,
            'b' => 'duck under the table',
            'b_file' => null,
            'c' => 'park your car',
            'c_file' => null,
            'd' => 'run to a tall tree',
            'd_file' => null,
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 2,
            'question' => 'Which famous Philippine volcano is usually seen in world maps due to its violent eruption in 1991?',
            'question_file' => null,
            'a' => 'Bulusan',
            'a_file' => null,
            'b' => 'Kanlaon',
            'b_file' => null,
            'c' => 'Mayon',
            'c_file' => null,
            'd' => 'Pinatubo',
            'd_file' => null,
            'correct_answer' => 'd'
        ]);

        /**
         * Abstract Reasoning Exam Question Grade 10
         */
        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/7YLUxRqIM00B3ZNn9XPArlBkXSvzAw8qu7jLkRd4.png',
            'a' => null,
            'a_file' => 'answers/e1In3z1WHLVdSj3TrOD21JB09exoTNe0mf0nKSls.png',
            'b' => null,
            'b_file' => 'answers/zI9uXUtAdxHDzt8cgvjRSgaUggmaS3YJeHbI0QhB.png',
            'c' => null,
            'c_file' => 'answers/vfELG9BCKBdwvzFUFLcSC6g8AGQdwTaef55KlfON.png',
            'd' => null,
            'd_file' => 'answers/Fj57u9dcXMiqQwG2g0EafwBUdgdsU9eZVx94s8rB.png',
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/mbVWJFr54HzhbktcWR7Gh1Z6p1Lo5OKIKGcYw4gx.png',
            'a' => null,
            'a_file' => 'answers/Sm9CL1aMHoBBDSFAHoTD6bGIzTRxGrgz7q6YlesP.png',
            'b' => null,
            'b_file' => 'answers/a9vPtiPu9ATTWlZ6OyleJ5Ai1tHNsr8BREOpbc5G.png',
            'c' => null,
            'c_file' => 'answers/TyoWtXh5SElHFIGyk42sAXDHBmtZxvpvHDLZ3QRD.png',
            'd' => null,
            'd_file' => 'answers/ZMLCNvaU2kY6BvxYDTthLf8SsI55mmPmnOjO2rHe.png',
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/JNaHjXmtXdR2YhmnhycvOJI3WGklXwMjlZemHT0p.png',
            'a' => null,
            'a_file' => 'answers/Aqy7nu8bS2oIyFpjeJVgszhpRsiJjPHgFXnhhup0.png',
            'b' => null,
            'b_file' => 'answers/p5CxiJq2mzFAyEkNyGXeqx8j4dIH2Bom4KbzYsCr.png',
            'c' => null,
            'c_file' => 'answers/qBz9J3lVId834ZG4dDVhMS5dyb3u8i04E40cyTbb.png',
            'd' => null,
            'd_file' => 'answers/uTX48UEKwB6VSNZ8BQ6rEZN3DUNU6MOmq71wRRe0.png',
            'correct_answer' => 'b'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/wiFdAjohk6aDUl8faje0Q09CnQwlzGBJoY3AI7fx.png',
            'a' => null,
            'a_file' => 'answers/pqwDQmJHZToUVqkMSVt4UYcsgb5tNmIGJAD0VnJa.png',
            'b' => null,
            'b_file' => 'answers/EEPCJvYeQLF0bNTZE4hLBNfdlQ77dX8oy8LlANGc.png',
            'c' => null,
            'c_file' => 'answers/eeK4Vacfu6MtK7temE5851R5f1WpaLD311UPlYZl.png',
            'd' => null,
            'd_file' => 'answers/U5Cf87mmSHhAvCMwsgOEGvBBizpaU9P7o09tix5a.png',
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/LEmdMcQX0EyedYWkM2M8qmPkSjDgJdpHnAoDSXhU.png',
            'a' => null,
            'a_file' => 'answers/PIdF8AfBIF4gZZmXAMWv1muGM5utDE6sDrVmplYU.png',
            'b' => null,
            'b_file' => 'answers/UBufI1ckkCCzj8lOaVtZy3wu1AtPLLVsblmgNCbO.png',
            'c' => null,
            'c_file' => 'answers/xa7ZccaRYyiFdrQseyGbklN1Txjuoe2bcp9V8qUV.png',
            'd' => null,
            'd_file' => 'answers/Pvfmblzxx8UmtuQFfY5jVAZWiATCVNPBUAvOgO8k.png',
            'correct_answer' => 'b'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/fEbP53h0vFaO5eNBL5RM5REpdXfhDqPwBGjNds4x.png',
            'a' => null,
            'a_file' => 'answers/D0bjN3dTHp3GF0e1V0mOnUDaKCDZrXDdqhOP9pf8.png',
            'b' => null,
            'b_file' => 'answers/DTfhMlMREltmAAEkMoesLgtVWwAhwUcj8B6cF0yc.png',
            'c' => null,
            'c_file' => 'answers/kcAq2PwlcEIZKrRyWsRVHFlhYjlDrF4lSnuOQPIO.png',
            'd' => null,
            'd_file' => 'answers/gpwgmNMvZ3Dinj44rAjq8fey3OVABevm85Br2E3C.png',
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/JkAk1qJWAAAkkSOlGCIIrrsDyxWo0R2hj80Hz6jB.png',
            'a' => null,
            'a_file' => 'answers/MO3BI3kOnZx85gwzwtM8Uj1RdcQ17UKA8YHUELDJ.png',
            'b' => null,
            'b_file' => 'answers/3VNtxVr3CK7CV91DBvUQEcMwldutbroBhNegvSmk.png',
            'c' => null,
            'c_file' => 'answers/ge07Tem0fX7goAHKxMBHtUkczGujBuZGAZKRHOWv.png',
            'd' => null,
            'd_file' => 'answers/CwecSXGH7oxxsUK0ZXmmlZlWkEll2XDZtImlp1Dv.png',
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/GxSoHiRbIyh25L9e78Twn73U0TbZ68GfSrrz3wsa.png',
            'a' => null,
            'a_file' => 'answers/LOQ5E2OooceJZ58pzFzafPBKAZvCZmcvPOIL3P6q.png',
            'b' => null,
            'b_file' => 'answers/tLZcnMZLEhQAQ8V5BweUEVP7qrnHYbdhHYtkRmwW.png',
            'c' => null,
            'c_file' => 'answers/51qQHXA4dSiNgDRgnvWydFZoVDl2PvDZSPUwXV1B.png',
            'd' => null,
            'd_file' => 'answers/sIAkoesFYZ8gL7Z4y1ZjILPMbSvJiFrjtVsEKrwC.png',
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/pRgMF0zEmgdtsK7X3kuz3lqkqQXeEx88IBlmMFam.png',
            'a' => null,
            'a_file' => 'answers/Qrkfe7yvfKghehbyl7OPdPcZcWSzpQUxctkxSkTT.png',
            'b' => null,
            'b_file' => 'answers/vXklBazG1kFBq4vDKlNIEDwN9QEwjGQfKxsJipMQ.png',
            'c' => null,
            'c_file' => 'answers/7qTyrgPzEgWZYKxOlcFGneotcSJN63IeqZoiYMYM.png',
            'd' => null,
            'd_file' => 'answers/9G0aWINFT3RnJGPcsP8wr1dBfMfdxmqO0n8OqTMF.png',
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/fIWtUhfOHEV7sgi45zciSylyXUBYzCXWbAdlmudO.png',
            'a' => null,
            'a_file' => 'answers/QsvOjQFoPndl7fvHPqgwB93TavGbeuRulN2BhGdl.png',
            'b' => null,
            'b_file' => 'answers/ybnya67aBtix7Rmr74Rqz8gDgyvFHqhNBYLmnGPp.png',
            'c' => null,
            'c_file' => 'answers/IDhUPfUV67k5KzRypEsLQRoexBhigbkMXU7j7GLN.png',
            'd' => null,
            'd_file' => 'answers/0yQvnWKgGTAJsyFPe7wwb4qyUSkDQMrbrmfsn2Xf.png',
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/lQFrgA8Lz5lOvEE6QyxM3nzEaqChD2kKaGnzCUHQ.png',
            'a' => null,
            'a_file' => 'answers/tSB1I48vY9zhgVscGXdLZl3IT4Fu89J8huC54Fby.png',
            'b' => null,
            'b_file' => 'answers/uC6rs3wBOvtmp62hb9lj7NUIaZqKI7JgbPUwhSCA.png',
            'c' => null,
            'c_file' => 'answers/VCGjpCETPJmPFMej6XjAI52IK0DYTgDHPK1xspu2.png',
            'd' => null,
            'd_file' => 'answers/hdmrwnI5DNahpbYkLTwCdlTq0umSZ6XLYkhnjHc7.png',
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/1gVQ7C4jnwpLdPHfrx3DtEGo95Mo0TA9k4mWhVAX.png',
            'a' => null,
            'a_file' => 'answers/Sem8CtrwfRdke7IsVpUjb1JTQLzdHfVMGizo76bV.png',
            'b' => null,
            'b_file' => 'answers/TAS0KKF2DNujDI8jkTiJ2WzQ5HriffwmsbWtEcjA.png',
            'c' => null,
            'c_file' => 'answers/321OfHZ8yP35riioWUnwMqYplKJUZpCWozioTpuT.png',
            'd' => null,
            'd_file' => 'answers/WWKdW43JKxXCFccFxUnRQ6Uw99RWucYiIRnrUXso.png',
            'correct_answer' => 'b'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/v7eQHogI2BbgEZPTo3pEePPy7wbj48d2cwC9VaYq.png',
            'a' => null,
            'a_file' => 'answers/mrS0MFU25D5hTSMnMd99zrSpeELing6ZLE0YVQqn.png',
            'b' => null,
            'b_file' => 'answers/PWT1dlX8k69AVq2PTU930eXm62OIgWZdo9TGHuE3.png',
            'c' => null,
            'c_file' => 'answers/75OGW2VobLlXQrnYBIehdpDFWoNxWKgvBOCs1qFl.png',
            'd' => null,
            'd_file' => 'answers/jFlQG5qTtclAwxkK6y0ccVqcRK2GgntrIRAIAXch.png',
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/YYzCUWGfzfk9HIC1uGOzBazkyVefSbU0IizCewpO.png',
            'a' => null,
            'a_file' => 'answers/560hWwICLBFeWLKZQZtwgd6rm5OriL31LyrAWFpH.png',
            'b' => null,
            'b_file' => 'answers/W4AWt9FhVQJITY6oczcsXrddtryEQUWq6jwTGiFo.png',
            'c' => null,
            'c_file' => 'answers/O1IAyv0bAsr0aUv4zzgXJ9wCodZoZB3WBLcjSuHn.png',
            'd' => null,
            'd_file' => 'answers/oaBQal6fdLXHR8L3QPzLm05tmRqr9V19jovJ0O96.png',
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/qBr2YL1PByDW3hwORBSWRKYDv93AHIQohSPf1zWi.png',
            'a' => null,
            'a_file' => 'answers/AtYd3CIUOctmSo0kQL2ccJrA43vdZQpX3duW4lml.png',
            'b' => null,
            'b_file' => 'answers/k7JPg4DdtIAY181hDY3dVkkq5hjl4rQ9KDUVQ6GY.png',
            'c' => null,
            'c_file' => 'answers/I7A5YCsdJ6a0u3KOwTvgvVe9Llwt0AHMYOngx3WB.png',
            'd' => null,
            'd_file' => 'answers/2jNOVO5JSm3pEXszYk0zpHXLqAmWCxQAFRXuMzbF.png',
            'correct_answer' => 'a'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/vVbLWSqhqroD5714n6ovJeZgqki1whIp1dPi350A.png',
            'a' => null,
            'a_file' => 'answers/KnBJPeWu6NUZjjUkbY2qZxCXKZxZUxV0Vgg935t0.png',
            'b' => null,
            'b_file' => 'answers/qfDQ5joop8aaZ9ScITBLzdVlarzSmiLzYeknBAtf.png',
            'c' => null,
            'c_file' => 'answers/qX4ew26CCmdZbw2BTY74bENdM6tU1cdhIFjBrhOr.png',
            'd' => null,
            'd_file' => 'answers/ZJ5d2PY2E7Wrk61f0JlUn7xV8f2aF0OuJjpnz6U1.png',
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/9cCmtlnFaDJ7NOVAYdyKHUBKGOiaD3yA1wsIixLp.png',
            'a' => null,
            'a_file' => 'answers/9FuM0Hm2RLxiki02CB51CTQAiwJfQmc2oxUby9w8.png',
            'b' => null,
            'b_file' => 'answers/E7sZjqFV9epWArtp2XuGvyYGh8p39XeCkhnVtu2Y.png',
            'c' => null,
            'c_file' => 'answers/8m528g08AIHMbcbkpiNXXQrAQeUCGu3qy1WQRmnN.png',
            'd' => null,
            'd_file' => 'answers/sjioypQgvbjpDEvuCPn7BDPeUsUDyDm6iMkjmANg.png',
            'correct_answer' => 'c'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/U5BS6f3P3CPd5Uu1LZX7MFSfsSrxmCiUOoNvGbis.png',
            'a' => null,
            'a_file' => 'answers/Gfu46YQwkhknHFijO7327ahNBqKZqSkMXPrnSM3A.png',
            'b' => null,
            'b_file' => 'answers/z526aOoMjtGipnFh5b9wagIAglZzqKdAnFqHJIzU.png',
            'c' => null,
            'c_file' => 'answers/y22QhXoJEy76ZtnEKFr93Zwx6xK78kepyuO6lcKx.png',
            'd' => null,
            'd_file' => 'answers/HKxM30xw5STvbF0kDFTu5EGroGb1CBl8MaYNW9lN.png',
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/LeL8H9nkdYoPXUvlmixXhoBE8YoEFvkAfBMjboUq.jpg',
            'a' => null,
            'a_file' => 'answers/r8nD6XIDnjU1R5OJMvXnjsxbGqBAJGAofGDCS9jv.jpg',
            'b' => null,
            'b_file' => 'answers/181d1ShPqa0xJftsEScrde3lmzqf6IeiakDSNqDG.jpg',
            'c' => null,
            'c_file' => 'answers/j7bIbRpmev189D9feZDseWNofOkmrW1YjjSYVQlY.jpg',
            'd' => null,
            'd_file' => 'answers/4gAs5s19s8wBDe2FsFLsCINo6UBGwwdM4sTnKSBb.jpg',
            'correct_answer' => 'd'
        ]);

        Question::create([
            'exam_id' => 3,
            'question' => null,
            'question_file' => 'questions/fxghRFsB8XSxXkEWeOAmaRVaKY5NBL0CHt4sg2TS.jpg',
            'a' => null,
            'a_file' => 'answers/6kmtoJJlSj1iPM9HfhsQnmPQyIZD5fkrVeqjEafG.jpg',
            'b' => null,
            'b_file' => 'answers/N7lSas1WFWkdAiW85DKuUx4khYmVT33acXaN4dtY.jpg',
            'c' => null,
            'c_file' => 'answers/7cHscntpZud6exyCbD88ylBEGlB3mfyhmGfxKWta.jpg',
            'd' => null,
            'd_file' => 'answers/OCyXXCXchitclUb8qH1WYZAmCUgerCezUjT89afu.jpg',
            'correct_answer' => 'a'
        ]);
    }
}
