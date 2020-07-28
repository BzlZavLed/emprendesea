<?php
 
 namespace App\Controller;
	use App\Entity\Books;
	use App\Entity\Students;
	use App\Entity\Conference;
	use App\Entity\Campos;
	use App\Entity\Escuela;
	use App\Entity\Temporadas;
	use App\Entity\Promo;
	use App\Entity\IndxStudent;
	use App\Entity\ExtraConfig;
  use App\Entity\Legal;
  use App\Entity\Pedido;
  use App\Entity\PedidoContent;
  use App\Entity\DeliveryRate;

  use Symfony\Component\HttpFoundation\JsonResponse;
 	use Symfony\Component\HttpFoundation\Response;
 	use Symfony\Component\HttpFoundation\Request;
 	use Symfony\Component\Routing\Annotation\Route;
 	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
 	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
  use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

	use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\Extension\Core\Type\TextareaType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\Extension\Core\Type\FileType;
	use Symfony\Component\Form\Extension\Core\Type\NumberType;
	use Symfony\Component\Form\Extension\Core\Type\CollectionType;
	use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
  use Symfony\Component\Validator\Constraints\DateTime;
	use Symfony\Component\Filesystem\Filesystem;
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;

	class DefaultController extends Controller{
 		/**
 		* @Route("/", name="index")
 		* @Method("GET")
 		*/
 		public function index(){
      /*$promos = $this->getDoctrine()->getRepository(Promo::class)->findAll();
      $students = $this->getDoctrine()->getRepository(IndxStudent::class)->findAll();
      $youtube = $this->getDoctrine()->getRepository(ExtraConfig::class)->findAll();
      return $this->render('store/index.html.twig', array('menu' => 0, 'promos' => $promos, "students" => $students, "youtube" => $youtube));*/
      $legal = $this->getDoctrine()->getRepository(Legal::class)->findAll();
      return $this->render('store/index.html.twig', array('menu' => 0, 'legal' => $legal));
 		}
    /**
    * @Route("/historias", name="historias")
    * @Method("GET")
    */
    public function historias(){
      $legal = $this->getDoctrine()->getRepository(Legal::class)->findAll();
      return $this->render('store/histories.html.twig', array('menu' => 1, 'legal' => $legal));
    }
    /**
    * @Route("/universitarios", name="universitarios")
    */
    public function universitarios(){
      $sql = " SELECT students.id, students.name, students.apellidos, students.foto, students.descripcion, students.correo, escuela.name AS facultad FROM students INNER JOIN escuela ON students.facultad = escuela.id ORDER BY rand()";

      $em = $this->getDoctrine()->getManager();
      $stmt = $em->getConnection()->prepare($sql);
      $stmt->execute();
      $students = $stmt->fetchAll();
      $escuela = $this->getDoctrine()->getRepository(Escuela::class)->findAll();
      $legal = $this->getDoctrine()->getRepository(Legal::class)->findAll();
      return $this->render('store/students.html.twig', array('menu' => 2, 'legal' => $legal, 'students' => $students, 'escuela'=>$escuela, 'filted'=>false, 'uni'=>null));
    }
    /**
    * @Route("/universitarios/by/{id}", name="studentsById")
    * @Method("GET")
    */
    public function studentsById($id){
      $sql = " SELECT students.id, students.name, students.apellidos, students.foto, students.descripcion,students.correo, escuela.name AS facultad FROM students INNER JOIN escuela ON students.facultad = escuela.id WHERE students.facultad = ".$id;

      $em = $this->getDoctrine()->getManager();
      $stmt = $em->getConnection()->prepare($sql);
      $stmt->execute();
      $students = $stmt->fetchAll();
      $escuela = $this->getDoctrine()->getRepository(Escuela::class)->findAll();
      $legal = $this->getDoctrine()->getRepository(Legal::class)->findAll();
      return $this->render('store/students.html.twig', array('menu' => 2, 'legal' => $legal, 'students' => $students, 'escuela'=>$escuela, 'filted' => true, 'uni'=>null));
    }
 /**
    * @Route("/universitarios/by/uni/{uni}", name="studentsByUni")
    * @Method("GET")
    */
    public function studentsByUni($uni){
      $sql = " SELECT students.id, students.name, students.apellidos, students.foto, students.descripcion,students.correo, escuela.name AS facultad FROM students INNER JOIN escuela ON students.facultad = escuela.id WHERE students.uni = ".$uni;

      $em = $this->getDoctrine()->getManager();
      $stmt = $em->getConnection()->prepare($sql);
      $stmt->execute();
      $students = $stmt->fetchAll();
      $escuela = $this->getDoctrine()->getRepository(Escuela::class)->findAll();
      $legal = $this->getDoctrine()->getRepository(Legal::class)->findAll();
      return $this->render('store/students.html.twig', array('menu' => 2, 'legal' => $legal, 'students' => $students, 'escuela'=>$escuela, 'filted' => true, 'uni'=>null));
    }
    /**
    * @Route("/universitarios_search", name="universitarios_search")
    * @Method("POST")
    */
    public function searchUniversitario(Request $request){
      $text = $request->request->get('text');

      $sql = " SELECT students.id, students.name, students.apellidos, students.foto, students.descripcion,students.correo, escuela.name AS facultad FROM students INNER JOIN escuela ON students.facultad = escuela.id";

      $em = $this->getDoctrine()->getManager();
      $stmt = $em->getConnection()->prepare($sql);
      $stmt->execute();
      $students = $stmt->fetchAll();
      $escuela = $this->getDoctrine()->getRepository(Escuela::class)->findAll();
      $legal = $this->getDoctrine()->getRepository(Legal::class)->findAll();
      if ($text == '' || $text == null){
        return $this->render('store/students.html.twig', array('menu' => 2, 'legal' => $legal, 'students' => $students, 'escuela'=>$escuela,'filted'=>false, 'uni'=>null));
      }

      $results = [];
      foreach ($students as $student) {
        if($student['id']==$text){
          $results[] = $student;
        }else if(strpos(strtolower($student['name']),strtolower($text)) !== false){
          $results[] = $student;
        }else if(strpos(strtolower($student['apellidos']),strtolower($text)) !== false){
          $results[] = $student;
        }else if(strpos(strtolower($student['facultad']),strtolower($text)) !== false){
          $results[] = $student;
        }
      }
      
      return $this->render('store/students.html.twig', array('menu' => 2, 'legal' => $legal, 'students' => $results, 'escuela'=>$escuela,'filted'=>false, 'uni'=>null));
    }
    /**
    * @Route("/universitarios/{id}", name="universitario")
    * @Method("POST")
    */
    function showStudent($id){
      $sql = " SELECT students.id, students.name, students.apellidos, students.foto, students.descripcion, students.correo, escuela.name AS facultad FROM students INNER JOIN escuela ON students.facultad = escuela.id";

      $em = $this->getDoctrine()->getManager();
      $stmt = $em->getConnection()->prepare($sql);
      $stmt->execute();
      $students = $stmt->fetchAll();
      $escuela = $this->getDoctrine()->getRepository(Escuela::class)->findAll();
      
      $sq = " SELECT students.id, students.name, students.apellidos, students.foto, students.descripcion,students.correo, escuela.name AS facultad FROM students INNER JOIN escuela ON students.facultad = escuela.id WHERE students.id = ".$id;

      $sm = $em->getConnection()->prepare($sq);
      $sm->execute();
      $student = $sm->fetchAll();
      $legal = $this->getDoctrine()->getRepository(Legal::class)->findAll();
      return $this->render('store/students.html.twig', array('menu' => 2, 'legal' => $legal, 'students' => $students, 'escuela'=>$escuela, 'filted' => false, 'uni'=>$student[0]));

    }
    /**
    * @Route("/libreria", name="libreria")
    */
    public function libreria(){
      $books = $this->getDoctrine()->getRepository(Books::class)->findAll();
shuffle($books);
      $legal = $this->getDoctrine()->getRepository(Legal::class)->findAll();
      return $this->render('store/library.html.twig',array('menu'=> 3, 'legal' => $legal, 'books'=>$books,'mode'=> 1));
    }

    /**
    * @Route("/libreria/by/{all}", name="showBooksBy")
    * @Method("GET")
    */
    public function libreriaFilter($all){
      $books = $this->getDoctrine()->getRepository(Books::class)->findAll();
      if ($all==0){
        $books = $this->getDoctrine()->getRepository(Books::class)->findBy([
            'year' => date("Y")
            ]);
      }
      $legal = $this->getDoctrine()->getRepository(Legal::class)->findAll();
      return $this->render('store/library.html.twig',array('menu'=> 3, 'legal' => $legal, 'books'=>$books, 'mode'=> $all));
    }

    /**
    * @Route("/libreria/libro/{id}", name="libro")
    * @Method("GET")
    */
    public function showLibro($id){
      $book = $this->getDoctrine()->getRepository(Books::class)->find($id);
      if ($book == null){
        return $this->redirectToRoute('libreria');
      }
      $legal = $this->getDoctrine()->getRepository(Legal::class)->findAll();
      return $this->render('store/book.html.twig',array('menu'=> 3, 'legal' => $legal, 'book'=>$book));
    }
    /**
    * @Route("/libreria/search", name="libreria_search")
    * @Method("POST")
    */
    public function libreriaSearch(Request $request){
      $books = $this->getDoctrine()->getRepository(Books::class)->findAll();
      $results = [];
      $text = $request->request->get('text');
      $legal = $this->getDoctrine()->getRepository(Legal::class)->findAll();
      if ($text == '' || $text == null){
        return $this->render('store/library.html.twig', array('menu'=> 3, 'legal' => $legal, 'books'=>$books, 'mode'=> 1));
      }
      foreach ($books as $book) {
        if($book->getId()==$text){
          $results[] = $book;
        }else if(strpos(strtolower($book->getTitulo()),strtolower($text)) !== false){
          $results[] = $book;
        }else if(strpos(strtolower($book->getAutor()),strtolower($text)) !== false){
          $results[] = $book;
        }else{
          foreach ($book->getCategorias() as $cat) {
            if(strpos(strtolower($cat),strtolower($text)) !== false){
              $results[] = $book;
              break;
            }
          }
        }
      }
      return $this->render('store/library.html.twig', array('menu'=> 3, 'legal' => $legal, 'books'=>$results, 'mode'=> 1));
    }
    /**
    * @Route("/faqs", name="faqs")
    * @Method("GET")
    */
    public function showFaqs(){
      $text = $this->getDoctrine()->getRepository(Legal::class)->findOneBy([
            'name' => 'faqs'
            ]);
      return $this->render('store/faqs.html.twig', array('preguntas' => $text));
    }
    /**
    * @Route("/tienda/carrito", name="first")
    */
    public function showFirst(){
      $legal = $this->getDoctrine()->getRepository(Legal::class)->findAll();
      return $this->render('store/first.html.twig', array('menu'=> 4, 'legal' => $legal));
    }
    /**
    * @Route("/tienda/carrito/success", name="success")
    * @Method("GET")
    */
    public function showSuccess(){
      $legal = $this->getDoctrine()->getRepository(Legal::class)->findAll();
      return $this->render('store/success.html.twig', array('menu'=> 4, 'legal' => $legal));
    }
    /**
    * @Route("/tienda/carrito/success/{id}", name="idcomplete")
    * @Method("GET")
    */
    public function showSuccessFin($id,\Swift_Mailer $mailer){
      $pedido = $this->getDoctrine()->getRepository(Pedido::class)->find($id);
      $legal = $this->getDoctrine()->getRepository(Legal::class)->findAll();

      $em = $this->getDoctrine()->getManager();
      $sq = 'SELECT students.name, students.apellidos, students.foto, escuela.name AS facultad FROM students INNER JOIN escuela ON students.facultad = escuela.id WHERE students.id = '.$pedido->getStudentId();
      $sm = $em->getConnection()->prepare($sq);
      $sm->execute();
      $student = $sm->fetchAll();

      $stu = $this->getDoctrine()->getRepository(Students::class)->find($pedido->getStudentId());
      $studentMail = (new \Swift_Message('Nuevo pedido en linea Emprendum'))
        ->setFrom('emprendum@emprendum.um.edu.mx')
        ->setTo($stu->getCorreo())
        ->setBody(
            $this->renderView(
                'mails/newPedidoMail.html.twig',
                array('id' => $id)
            ),
            'text/html '
        );
      $mailer->send($studentMail);

      $custumerMail = (new \Swift_Message('Confirmación Emprendum'))
        ->setFrom('emprendum@emprendum.um.edu.mx')
        ->setTo($pedido->getEmail())
        ->setBody(
            $this->renderView(
                // templates/emails/registration.html.twig
                'mails/confirmMail.html.twig',
                array('name' => $stu->getName(), 'id' => $id)
            ),
            'text/html '
        );
      $mailer->send($custumerMail);

      return $this->render('store/success.html.twig', array('menu'=> 4, 'legal' => $legal, "pedido" => $pedido, "student"=>$student[0]));
    }
    /**
    * @Route("/tienda/second", name="second")
    * @Method("GET")
    */
    public function showSecond(){
      $text = $this->getDoctrine()->getRepository(Legal::class)->findOneBy([
            'name' => 'priv'
            ]);
      return $this->render('store/second.html.twig', array('privs' => $text));
    }
    /**
    * @Route("/tienda/shippOps", name="shippOps")
    * @Method("POST")
    */
    public function showShippOps(Request $request){  
      $content = $request->getContent();
      $data = json_decode($content, true);
      $cdate = new \DateTime();

      $student = $this->getDoctrine()->getRepository(Students::class)->find($data['student_id']);
      $verano = $this->getDoctrine()->getRepository(Temporadas::class)->find(1);
      $invierno = $this->getDoctrine()->getRepository(Temporadas::class)->find(2);
      $campo_id = $student->getInter();

      if( $cdate >= $verano->getFechaInicial() && $cdate <= $verano->getFechaFinal() ){
        $campo_id = $student->getVerano();
      }else if( $cdate >= $invierno->getFechaInicial() && $cdate <= $invierno->getFechaFinal() ){
        $campo_id = $student->getInvierno();
      }

      $pedido = new Pedido();
      $pedido->setName($data['FirstName']);
      $pedido->setLast($data['LastName']);
      $pedido->setPhone($data['phone']);
      $pedido->setEmail($data['email']);
      $pedido->setStreet($data['address']);
      $pedido->setCity($data['city']);
      $pedido->setEntre($data['streets']);
      $pedido->setCp($data['postal']);
      $pedido->setState($data['state']);
      $pedido->setRequestDate($cdate);
      $pedido->setStudentId($data['student_id']);
      $pedido->setStdName($data['std_name']);
      $pedido->setStdPlace($data['std_place']);
      $pedido->setStdDate($data['std_date']);
      $pedido->setCampoId($campo_id);

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($pedido);
      $entityManager->flush();
      
      $length = 0;
      $height = 0;
      $width = 0;
      $weight = 0;
      $mount = 0;

      $ids = $data["ids"];
      foreach ($ids as $id) {
        $book = $this->getDoctrine()->getRepository(Books::class)->find($id["id"]);

        $length += ($book->getLength() * $id["qtt"]);

        if($book->getHeight()>$height){ 
          $height = $book->getHeight();
        }
        if($book->getWidth()>$width){
          $width = $book->getWidth();
        }
        
        $weight += ($book->getPeso() * $id["qtt"]);
        $mount += ($book->getPublico() * $id["qtt"]);

        $content = new PedidoContent();
        $content->setPedidoId($pedido->getId());
        $content->setBookId($id["id"]);
        $content->setQtt($id["qtt"]);
        $content->setUnitPriceList($book->getColportor());
        $content->setUnitPrice($book->getPublico());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($content);
        $entityManager->flush();
      }
      /*

      $post = [
        "enviaya_account" => "VG569PVZ",
        "carrier_account" => null,
        "api_key" => "f051304371c30ee186fc69804ccd78a2",
        "shipment" => [
              "shipment_type" => "Package",
              "parcels" => [array(
                "quantity" => "1",
                "weight" => $weight,
                "weight_unit" => "kg",
                "length" => $length,
                "height" => $height,
                "width" => $width,
                "dimension_unit" => "cm"
              )
            ]
          ],
        "origin_direction" => [
          "country_code" => "MX",
          "postal_code" => "67530"
        ],
        "destination_direction" => [
          "country_code" => "MX",
          "postal_code" => $data["postal"]
        ],
        "insured_value" => $mount,
        "insured_value_currency" => "MXN",
        "order_total_amount" => $mount,
        "currency" => "MXN"
      ];

      $url = 'https://enviaya.com.mx/api/v1/rates';
 
      $ch=curl_init($url);
      $payload = json_encode( $post );
      curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      # Send request.
      $decodedText = html_entity_decode(curl_exec($ch));
      $result = json_decode($decodedText, true);
      curl_close($ch);
      $cariers = array_keys($result);
        
      for($i=1;$i<(sizeof($cariers)-1);$i++){
        foreach(($result[$cariers[$i]]) as $rate){
          $sop = new DeliveryRate();
          $sop->setPedidoId($pedido->getId());
          $sop->setCarrier($cariers[$i]);
          if(array_key_exists('rate_id', $rate)){
            $sop->setRateId($rate['rate_id'] === null ? '':$rate['rate_id']);
            $sop->setCost($rate['net_total_amount'] === null ? '':$rate['net_total_amount']);
            $sop->setLogo($rate['carrier_logo_url'] === null ? '':$rate['carrier_logo_url']);
            $sop->setService($rate['dynamic_service_name'] === null ? '':$rate['dynamic_service_name']);
            $fecha = new \DateTime($rate['estimated_delivery'] === null ? '':$rate['estimated_delivery']);
            $sop->setDelivery($fecha);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sop);
            $entityManager->flush();
          }
          
        }
      }
      //
      $shippsRepo = $this->getDoctrine()->getRepository(DeliveryRate::class);
      $shipps = $shippsRepo->findBy([
        'pedido_id' => $pedido->getId()
      ]);
      $rates = array();
      
      foreach($shipps as $shipp){
        $obj = array(
          "id"=>$shipp->getRateId(),
          "cost"=>$shipp->getCost(),
          "service"=>$shipp->getService(),
          "delivery"=>$shipp->getDelivery(),
          "carrier"=>$shipp->getCarrier(),
          "pedido_id"=>$shipp->getPedidoId()
        );
        $PedidoId = $shipp->getPedidoId();
        array_push($rates, $obj);
      }
      //Agergamos un Tipo de Entrega (fisica) antes de las que consultamos 
      /*$objCero=array(
        "id"=>"99999",
        "cost"=>0,
        "service"=>"Fisico",
        "delivery"=>"Inmediato",
        "carrier"=>"Libreria UM",
        "pedido_id"=>$PedidoId
      );
      array_push($rates, $objCero);*/
      //return new JsonResponse(json_encode($rates));
      return new JsonResponse($pedido->getId());

    }
    /**
    * @Route("tienda/shippOps/{id}", name="shipspick")
    * @Method("GET")
    */
    public function showShippPicker($id){
      $shippsRepo = $this->getDoctrine()->getRepository(DeliveryRate::class);
      $shipps = $shippsRepo->findBy([
        'pedido_id' => $id
      ]);
      return $this->render('store/shippPicker.html.twig', array('rates' => $shipps, 'pedido'=>$id));
    }
    /**
    * @Route("tienda/shippOps/{pid}/{shipp}", name="shipspicked")
    * @Method("GET")
    */
    public function showResumen($pid,$shipp){
      $entityManager = $this->getDoctrine()->getManager();

      $pedido = $entityManager->getRepository(Pedido::class)->find($pid);
      $shippRepo = $entityManager->getRepository(DeliveryRate::class);
      $shipp = $shippRepo->findOneBy([
        'rate_id' => $shipp
      ]);
      $pedido->setShipId($shipp->getRateId());
      $pedido->setCarrier($shipp->getCarrier());
      $pedido->setDeliveryService($shipp->getService());
      $pedido->setDeliveryPrice($shipp->getCost());

      $shipps = $shippRepo->findBy([
        'pedido_id' => $pid
      ]);
      foreach ($shipps as $sh) {
        $entityManager->remove($sh);
      }

      $entityManager->flush();
      return $this->render('store/resumen.html.twig', array('pedido_id' => $pid, 'delivery' => $pedido->getDeliveryPrice()));
    }
    /**
    * @Route("/pay", name="payMethods")
    */
    public function showPayMethods(){
      return $this->render('store/payMethods.html.twig');
    }
    /**
    * @Route("/pay/cardform", name="cardMenthod")
    */
    public function showCardMethod(){
      return $this->render('store/cardmethod.html.twig');
    }
    /**
    * @Route("/pay/done", name="done")
    * @Method("GET")
    */
    public function done($id){
      return $this->render('store/done.html.twig');
    }
    /**
    * @Route("/pay/done/{id}", name="showdone")
    * @Method("GET")
    */
    public function showDone($id,\Swift_Mailer $mailer){
      $entityManager = $this->getDoctrine()->getManager();
      $pedido = $entityManager->getRepository(Pedido::class)->find($id);
      $student = $entityManager->getRepository(Students::class)->find($pedido->getStudentId());

      $studentMail = (new \Swift_Message('Nuevo pedido en linea Emprendum'))
        ->setFrom('emprendum@emprendum.um.edu.mx')
        ->setTo($student->getCorreo())
        ->setBody(
            $this->renderView(
                'mails/newPedidoMail.html.twig',
                array('id' => $id)
            ),
            'text/html '
        );
      $mailer->send($studentMail);

      $custumerMail = (new \Swift_Message('Confirmación Emprendum'))
        ->setFrom('emprendum@emprendum.um.edu.mx')
        ->setTo($pedido->getEmail())
        ->setBody(
            $this->renderView(
                // templates/emails/registration.html.twig
                'mails/confirmMail.html.twig',
                array('name' => $student->getName(), 'id' => $id)
            ),
            'text/html '
        );
      $mailer->send($custumerMail);
      return $this->render('store/done.html.twig', array('pedido'=>$id));
    }
    /**
    * @Route("/mipedido", name="pedidoAccess")
    * @Method("POST")
    */
    public function showpAccess(Request $request){  
      $legal = $this->getDoctrine()->getRepository(Legal::class)->findAll();
      $data = $request->request->all();
      $id = $data["id"];
      $entityManager = $this->getDoctrine()->getManager();
      $pedido = $entityManager->getRepository(Pedido::class)->find($id);
      $content = $entityManager->getRepository(PedidoContent::class)->findBy([
        'pedido_id' => $id
      ]);

      $cArray = array();
      foreach ($content as $item) {
        $book = $entityManager->getRepository(Books::class)->find($item->getBookId());
        array_push($cArray, ["foto"=>$book->getPortada(),"name"=>$book->getTitulo(), "price"=>$item->getUnitPrice(), "quantity"=>$item->getQtt(), "total"=>$item->getUnitPrice()*$item->getQtt(), "autor"=>$book->getAutor(), "peso"=>$book->getPeso()]);
      } 

      $sq = " SELECT students.id, students.name, students.apellidos, students.foto, escuela.name AS facultad FROM students INNER JOIN escuela ON students.facultad = escuela.id WHERE students.id = ".$pedido->getStudentId();

      $sm = $entityManager->getConnection()->prepare($sq);
      $sm->execute();
      $student = $sm->fetchAll();

      return $this->render('store/mipedido.html.twig', array('menu'=>5, 'legal' => $legal, 'pedido' => $pedido, 'content' => $cArray, 'student'=>$student[0]));
    }
    /**
    * @Route("/mipedidoerror/{error}", name="pedidoAccessError")
    * @Method("GET")
    */
    public function showpeAccess($error){
      return $this->render('store/mipedidoAccess.html.twig', array('error'=>$error));
    }
    /**
    * @Route("/mipedido/{id}", name="mipedido")
    * @Method("GET")
    */
    public function showpDetails($id){
      $entityManager = $this->getDoctrine()->getManager();
      $pedido = $entityManager->getRepository(Pedido::class)->find($id);
      if ($pedido == null){
        return $this->redirectToRoute('pedidoAccessError', array('error' => 'Número de pedido ingresado no existe'));
      }
      $contentRepo = $entityManager->getRepository(PedidoContent::class);
      $content = $contentRepo->findBy([
        'pedido_id' => $id
      ]);
      $cArray = array();
      $subtotal = 0;
      $total = 0;
      foreach ($content as $item) {
        $book = $entityManager->getRepository(Books::class)->find($item->getBookId());
        array_push($cArray, ["foto"=>$book->getPortada(),"name"=>$book->getTitulo(), "price"=>$item->getUnitPrice(), "quantity"=>$item->getQtt(), "total"=>$item->getUnitPrice()*$item->getQtt()]);
        $subtotal += $item->getUnitPrice()*$item->getQtt();
      } 
      $total = $subtotal+$pedido->getDeliveryPrice();

      $sq = " SELECT students.id, students.name, students.apellidos, students.foto, escuela.name AS facultad FROM students INNER JOIN escuela ON students.facultad = escuela.id WHERE students.id = ".$pedido->getStudentId;

      $sm = $em->getConnection()->prepare($sq);
      $sm->execute();
      $student = $sm->fetchAll();

      return $this->render('store/mipedido.html.twig', array('pedido'=>$pedido, 'content'=>$cArray, 'subtotal'=>$subtotal, 'total'=>$total, 'student'=>$student[0]));
    }
    
    /**
    * @Route("tienda/pay/cash", name="paywithcash")
    * @Method("POST")
    */
    public function cashPayment(Request $request){
      $content = $request->getContent();
      $data = json_decode($content, true);
      $pid = $data['id'];
      $shipp = $data['shipp'];
      $dona = $data['dona']*100;
      $envio = $data['envio']*100;
      $alumId = $data['alumId'];
      $alumPhoto = $data['alumPhoto'];
      $alumMail = $data['alumMail'];
      $alumName = $data['alumName'];

      $entityManager = $this->getDoctrine()->getManager();
      $pedido = $entityManager->getRepository(Pedido::class)->find($pid);
     /*$shippRepo = $entityManager->getRepository(DeliveryRate::class);
      $shipp = $shippRepo->findOneBy([
        'rate_id' => $shipp
      ]);*/
      switch ($shipp) {
        case 1:
          $pedido->setShipId($shipp);
          $pedido->setCarrier("Físico");
          $pedido->setDeliveryService("Entregado por Universitario");
          $pedido->setDeliveryPrice($envio);
            break;
        case 2:
          $pedido->setShipId($shipp);
          $pedido->setCarrier("Correos de Mexico");
          $pedido->setDeliveryService("Entrega en 15 dias");
          $pedido->setDeliveryPrice($envio);
            break;
        case 3:
          $pedido->setShipId($shipp);
          $pedido->setCarrier("FedEx");
          $pedido->setDeliveryService("Entrega en 3-5 dias");
          $pedido->setDeliveryPrice($envio);
            break;
        case 4:
          $pedido->setShipId($shipp);
          $pedido->setCarrier("FedEx Usa");
          $pedido->setDeliveryService("Entrega en 3-5 dias");
          $pedido->setDeliveryPrice($envio);
            break;
        case 5:
          $pedido->setShipId($shipp);
          $pedido->setCarrier("DHL");
          $pedido->setDeliveryService("Entrega en 3-5 dias");
          $pedido->setDeliveryPrice(14400);
            break;
          default:
            break;
    }

     /*$shipps = $shippRepo->findBy([
        'pedido_id' => $pid
      ]);
      foreach ($shipps as $sh) {
        $entityManager->remove($sh);
      }
*/
      $entityManager->flush();
      //prueba
     // $ckey = "key_gq2BjykrFBQ5DjfRADiczQ";

      //produccion
      $ckey = "key_H3z4zps752h88zYYuRi2CA";

      $contentRepo = $entityManager->getRepository(PedidoContent::class);
      $content = $contentRepo->findBy([
        'pedido_id' => $pid
      ]);
      $cArray = array();
      $total = 0;
      $totalList = 0;
      foreach ($content as $item) {
        $book = $entityManager->getRepository(Books::class)->find($item->getBookId());
        array_push($cArray, ["name"=>$book->getTitulo(), "unit_price"=>$item->getUnitPrice(), "quantity"=>$item->getQtt()]);
        $total += ($item->getUnitPrice()*$item->getQtt());
        $totalList += ($item->getUnitPriceList()*$item->getQtt());
      }
      array_push($cArray, ["name"=>"Donacion", "unit_price"=>$dona, "quantity"=>1]);
      $post = [
      "line_items"=> $cArray,
      "shipping_lines"=> [array(
          "amount"=> intval($pedido->getDeliveryPrice()),
          "carrier"=> $pedido->getCarrier()
      )],
      "currency"=> "MXN",
      "customer_info"=> array(
        "name" => $pedido->getName()." ".$pedido->getLast(),
        "email" => $pedido->getEmail(),
        "phone" => $pedido->getPhone()
      ),
      "shipping_contact"=>array(
           "address"=> array(
               "street1"=> $pedido->getStreet(),
               "postal_code"=> $pedido->getCp(),
               "country"=> "MX"
           )
       ),
     "metadata"=> array("reference"=> $pedido->getId(), "mail" => $alumMail, "photo" => $alumPhoto, "id" => $alumId, "name" => $alumName, "total" =>$total/100 , "totalList"=> $totalList/100, "envio"=> $envio/100 ),
      "charges"=>[array(
          "payment_method"=> array(
              "type"=> "oxxo_cash"
          )
        )]
      ];
      $ch=curl_init('https://api.conekta.io/orders');
      $payload = json_encode( $post );
      curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, array('accept: application/vnd.conekta-v2.0.0+json','Content-Type:application/json'));
      curl_setopt( $ch, CURLOPT_USERPWD,$ckey);
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      $decodedText = html_entity_decode(curl_exec($ch));
      $presult = json_decode($decodedText, true);
      curl_close($ch); 

      $entityManager = $this->getDoctrine()->getManager();
      $pedido = $entityManager->getRepository(Pedido::class)->find($pid);
      $pedido->setPaymentId($presult["charges"]["data"][0]["order_id"]);
      $pedido->setTotal($total + $dona);
      $pedido->setTotalLista($totalList + $dona);
      $pedido->setTipoPago("oxxo");
      $entityManager->flush();
      return new JsonResponse(array('result'=>$presult));      
    }
    /**
    * @Route("tienda/pay/trans", name="paywithtrans")
    * @Method("POST")
    */
    public function transPayment(Request $request){
      $content = $request->getContent();
      $data = json_decode($content, true);
      $pid = $data['id'];
      $shipp = $data['shipp'];
      $dona = $data['dona']*100;
      $envio = $data['envio']*100;
      $alumId = $data['alumId'];
      $alumPhoto = $data['alumPhoto'];
      $alumMail = $data['alumMail'];
      $alumName = $data['alumName'];

      $entityManager = $this->getDoctrine()->getManager();
      $pedido = $entityManager->getRepository(Pedido::class)->find($pid);
      /*$shippRepo = $entityManager->getRepository(DeliveryRate::class);
      $shipp = $shippRepo->findOneBy([
        'rate_id' => $shipp
      ]);*/
      switch ($shipp) {
        case 1:
          $pedido->setShipId($shipp);
          $pedido->setCarrier("Físico");
          $pedido->setDeliveryService("Entregado por Universitario");
          $pedido->setDeliveryPrice($envio);
            break;
        case 2:
          $pedido->setShipId($shipp);
          $pedido->setCarrier("Correos de Mexico");
          $pedido->setDeliveryService("Entrega en 15 dias");
          $pedido->setDeliveryPrice($envio);
            break;
        case 3:
          $pedido->setShipId($shipp);
          $pedido->setCarrier("FedEx");
          $pedido->setDeliveryService("Entrega en 3-5 dias");
          $pedido->setDeliveryPrice($envio);
            break;
        case 4:
          $pedido->setShipId($shipp);
          $pedido->setCarrier("FedEx USA");
          $pedido->setDeliveryService("Entrega en 3-5 dias");
          $pedido->setDeliveryPrice($envio);
            break;
        case 5:
          $pedido->setShipId($shipp);
          $pedido->setCarrier("DHL");
          $pedido->setDeliveryService("Entrega en 3-5 dias");
          $pedido->setDeliveryPrice(14400);
            break;
          default:
            break;
    }

      /*$shipps = $shippRepo->findBy([
        'pedido_id' => $pid
      ]);
      foreach ($shipps as $sh) {
        $entityManager->remove($sh);
      }
*/
      $entityManager->flush();
      //prueba
      //$ckey = "key_gq2BjykrFBQ5DjfRADiczQ";

      //produccion
      $ckey = "key_H3z4zps752h88zYYuRi2CA";

      $contentRepo = $entityManager->getRepository(PedidoContent::class);
      $content = $contentRepo->findBy([
        'pedido_id' => $pid
      ]);
      $cArray = array();
      $total = 0;
      $totalList = 0;
      foreach ($content as $item) {
        $book = $entityManager->getRepository(Books::class)->find($item->getBookId());
        array_push($cArray, ["name"=>$book->getTitulo(), "unit_price"=>$item->getUnitPrice(), "quantity"=>$item->getQtt()]);
        $total += ($item->getUnitPrice()*$item->getQtt());
        $totalList += ($item->getUnitPriceList()*$item->getQtt());
      }
      array_push($cArray, ["name"=>"Donacion", "unit_price"=>$dona, "quantity"=>1]);

      $post = [
      "line_items"=> $cArray,
      "shipping_lines"=> [array(
          "amount"=> intval($pedido->getDeliveryPrice()),
          "carrier"=> $pedido->getCarrier()
      )],
      "currency"=> "MXN",
      "customer_info"=> array(
        "name" => $pedido->getName()." ".$pedido->getLast(),
        "email" => $pedido->getEmail(),
        "phone" => $pedido->getPhone()
      ),
      "shipping_contact"=>array(
           "address"=> array(
               "street1"=> $pedido->getStreet(),
               "postal_code"=> $pedido->getCp(),
               "country"=> "MX"
           )
       ),
       "metadata"=> array("reference"=> $pedido->getId(), "mail" => $alumMail, "photo" => $alumPhoto, "id" => $alumId, "name" => $alumName, "total" =>$total/100 , "totalList"=> $totalList/100, "envio"=> $envio/100 ),
       "charges"=>[array(
          "payment_method"=> array(
              "type"=> "spei"
          )
        )]
      ];
      $ch=curl_init('https://api.conekta.io/orders');
      $payload = json_encode( $post );
      curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, array('accept: application/vnd.conekta-v2.0.0+json','Content-Type:application/json'));
      curl_setopt( $ch, CURLOPT_USERPWD,$ckey);
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      $decodedText = html_entity_decode(curl_exec($ch));
      $presult = json_decode($decodedText, true);
      curl_close($ch); 

      $entityManager = $this->getDoctrine()->getManager();
      $pedido = $entityManager->getRepository(Pedido::class)->find($pid);
      $pedido->setPaymentId($presult["charges"]["data"][0]["order_id"]);
      $pedido->setTotal($total + $dona);
      $pedido->setTotalLista($totalList + $dona);
      $pedido->setTipoPago("TRANSACCION");
      $entityManager->flush();
      return new JsonResponse(array('result'=>$presult));      
    }
    
    /**
    * @Route("tienda/pay/card", name="paywithcard")
    * @Method("GET")
    */
    public function cardPayment(Request $request){
      $content = $request->getContent();
      $data = json_decode($content, true);
      $token = $data['token'];
      $pid = $data['id'];
      $sid = $data['shipp'];
      $dona = $data['dona']*100;
      $envio = $data['envio']*100;
      $alumId = $data['alumId'];
      $alumPhoto = $data['alumPhoto'];
      $alumMail = $data['alumMail'];
      $alumName = $data['alumName'];

      $entityManager = $this->getDoctrine()->getManager();
      $pedido = $entityManager->getRepository(Pedido::class)->find($pid);
     /* $shippRepo = $entityManager->getRepository(DeliveryRate::class);
      $shipp = $shippRepo->findOneBy([
        'rate_id' => $sid
      ]);*/
      switch ($sid) {
        case 1:
          $pedido->setShipId($sid);
          $pedido->setCarrier("Físico");
          $pedido->setDeliveryService("Entregado por Universitario");
          $pedido->setDeliveryPrice($envio);
            break;
        case 2:
          $pedido->setShipId($sid);
          $pedido->setCarrier("Correos de Mexico");
          $pedido->setDeliveryService("Entrega en 15 dias");
          $pedido->setDeliveryPrice($envio);
            break;
        case 3:
          $pedido->setShipId($sid);
          $pedido->setCarrier("FedEx");
          $pedido->setDeliveryService("Entrega en 3-5 dias");
          $pedido->setDeliveryPrice($envio);       
            break;
        case 4:
          $pedido->setShipId($sid);
          $pedido->setCarrier("FedEx USA");
          $pedido->setDeliveryService("Entrega en 3-5 dias");
          $pedido->setDeliveryPrice($envio);
            break;
        case 5:
          $pedido->setShipId($sid);
          $pedido->setCarrier("DHL");
          $pedido->setDeliveryService("Entrega en 3-5 dias");
          $pedido->setDeliveryPrice(14400);
            break;
          default:
            break;
    }

      $entityManager->flush();

    //  prueba
  //    $ckey = "key_gq2BjykrFBQ5DjfRADiczQ";

//produccion
$ckey= "key_H3z4zps752h88zYYuRi2CA";

      $post = [
        "name" => $pedido->getName(),
        "email" => $pedido->getEmail(),
        "phone" => $pedido->getPhone(),
        "payment_sources" =>[ array(
          "type" => "card",
          "token_id" => $token
        )]
      ];
 
      $ch=curl_init('https://api.conekta.io/customers');
      $payload = json_encode( $post );
      curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, array('accept: application/vnd.conekta-v2.0.0+json','Content-Type:application/json'));
      curl_setopt( $ch, CURLOPT_USERPWD,$ckey);
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      $decodedText = html_entity_decode(curl_exec($ch));
      $cresult = json_decode($decodedText, true);
      curl_close($ch);

      $contentRepo = $entityManager->getRepository(PedidoContent::class);
      $content = $contentRepo->findBy([
        'pedido_id' => $pid
      ]);

      $cArray = array();
      $total = 0;
      $totalList = 0;
      foreach ($content as $item) {
        $book = $entityManager->getRepository(Books::class)->find($item->getBookId());
        array_push($cArray, ["name"=>$book->getTitulo(), "unit_price"=>$item->getUnitPrice(), "quantity"=>$item->getQtt()]);
        $total += ($item->getUnitPrice()*$item->getQtt());
        $totalList += ($item->getUnitPriceList()*$item->getQtt());
      }
      array_push($cArray, ["name"=>"Donacion", "unit_price"=>$dona, "quantity"=>1]);

      $post = [
      "line_items"=> $cArray,
      "shipping_lines"=> [array(
          "amount"=> intval($pedido->getDeliveryPrice()),
          "carrier"=> $pedido->getCarrier()
      )],
      "currency"=> "MXN",
      "customer_info"=> array(
          "customer_id"=> $cresult['id'],
      ),
      "shipping_contact"=>array(
           "address"=> array(
               "street1"=> $pedido->getStreet(),
               "postal_code"=> $pedido->getCp(),
               "country"=> "MX"
           )
       ),
       "metadata"=> array("reference"=> $pedido->getId(), "mail" => $alumMail, "photo" => $alumPhoto, "id" => $alumId, "name" => $alumName, "total" =>$total/100 , "totalList"=> $totalList/100, "envio"=> $envio/100 ),
       "charges"=>[array(
          "payment_method"=> array(
              "type"=> "card",
              "payment_source_id"=> $cresult['default_payment_source_id']
          )
        )]
      ];

      $ch=curl_init('https://api.conekta.io/orders');
      $payload = json_encode( $post );
      curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, array('accept: application/vnd.conekta-v2.0.0+json','Content-Type:application/json'));
      curl_setopt( $ch, CURLOPT_USERPWD,$ckey);
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      $decodedText = html_entity_decode(curl_exec($ch));
      $presult = json_decode($decodedText, true);
      curl_close($ch);

      if($presult["object"]=="error"){
        $message = $presult["details"][0]["message"];
        return new JsonResponse(array('error'=>$message));
      }

      $entityManager = $this->getDoctrine()->getManager();
      $pedido = $entityManager->getRepository(Pedido::class)->find($pid);
      $pedido->setPaymentId($presult["charges"]["data"][0]["order_id"]);
      $pedido->setTotal($total+$dona);
      $pedido->setTotalLista($totalList+$dona);
      $pedido->setTipoPago("TARJETA");

     /* $shippRepo = $entityManager->getRepository(DeliveryRate::class); 
      $shipps = $shippRepo->findBy([
        'pedido_id' => $pid
      ]);
      foreach ($shipps as $sh) {
        $entityManager->remove($sh);
      }
*/
      $entityManager->flush();
  
      return new JsonResponse(array('contenido'=>$content));
    }
    /**
    * @Route("tienda/pay/card-month", name="paywithcardmonth")
    * @Method("GET")
    */
    public function cardMonthPayment(Request $request){
      $content = $request->getContent();
      $data = json_decode($content, true);
      $token = $data['token'];
      $pid = $data['id'];
      $sid = $data['shipp'];
      $month = $data['meses'];
      $dona = $data['dona']*100;
      $envio = $data['envio']*100;
      $alumId = $data['alumId'];
      $alumPhoto = $data['alumPhoto'];
      $alumMail = $data['alumMail'];
      $alumName = $data['alumName'];

      $entityManager = $this->getDoctrine()->getManager();
      $pedido = $entityManager->getRepository(Pedido::class)->find($pid);
     /* $shippRepo = $entityManager->getRepository(DeliveryRate::class);
      $shipp = $shippRepo->findOneBy([
        'rate_id' => $sid
      ]);*/
      switch ($sid) {
        case 1:
          $pedido->setShipId($sid);
          $pedido->setCarrier("Físico");
          $pedido->setDeliveryService("Entregado por Universitario");
          $pedido->setDeliveryPrice($envio);
            break;
        case 2:
          $pedido->setShipId($sid);
          $pedido->setCarrier("Correos de Mexico");
          $pedido->setDeliveryService("Entrega en 15 dias");
          $pedido->setDeliveryPrice($envio);
            break;
        case 3:
          $pedido->setShipId($sid);
          $pedido->setCarrier("FedEx");
          $pedido->setDeliveryService("Entrega en 3-5 dias");
          $pedido->setDeliveryPrice($envio);       
            break;
        case 4:
          $pedido->setShipId($sid);
          $pedido->setCarrier("FedEx USA");
          $pedido->setDeliveryService("Entrega en 3-5 dias");
          $pedido->setDeliveryPrice($envio);
            break;
        case 5:
          $pedido->setShipId($sid);
          $pedido->setCarrier("DHL");
          $pedido->setDeliveryService("Entrega en 3-5 dias");
          $pedido->setDeliveryPrice(14400);
            break;
          default:
            break;
    }

      $entityManager->flush();

    //prueba      
      //$ckey = "key_gq2BjykrFBQ5DjfRADiczQ";

      //produccion
      $ckey = "key_H3z4zps752h88zYYuRi2CA";

      $post = [
        "name" => $pedido->getName(),
        "email" => $pedido->getEmail(),
        "phone" => $pedido->getPhone(),
        "payment_sources" =>[ array(
          "type" => "card",
          "token_id" => $token
        )]
      ];
 
      $ch=curl_init('https://api.conekta.io/customers');
      $payload = json_encode( $post );
      curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, array('accept: application/vnd.conekta-v2.0.0+json','Content-Type:application/json'));
      curl_setopt( $ch, CURLOPT_USERPWD,$ckey);
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      $decodedText = html_entity_decode(curl_exec($ch));
      $cresult = json_decode($decodedText, true);
      curl_close($ch);

      $contentRepo = $entityManager->getRepository(PedidoContent::class);
      $content = $contentRepo->findBy([
        'pedido_id' => $pid
      ]);

      $cArray = array();
      $total = 0;
      $totalList = 0;
      $aumento= 0;
      foreach ($content as $item) {
        $book = $entityManager->getRepository(Books::class)->find($item->getBookId());
        array_push($cArray, ["name"=>$book->getTitulo(), "unit_price"=>$item->getUnitPrice(), "quantity"=>$item->getQtt()]);
        $total += ($item->getUnitPrice()*$item->getQtt());
        $totalList += ($item->getUnitPriceList()*$item->getQtt());
      }
      array_push($cArray, ["name"=>"Donacion", "unit_price"=>$dona, "quantity"=>1]);

      switch ($month){
        case 3:
          $aumento = (($total+$dona+intval($pedido->getDeliveryPrice())+2.9)/(0.96636-(1.16*0.049)))-($total+$dona+intval($pedido->getDeliveryPrice()));
        break;
        case 6:
          $aumento = (($total+$dona+intval($pedido->getDeliveryPrice())+2.9)/(0.96636-(1.16*0.079)))-($total+$dona+intval($pedido->getDeliveryPrice()));
        break;
        case 9:
          $aumento = (($total+$dona+intval($pedido->getDeliveryPrice())+2.9)/(0.96636-(1.16*0.109)))-($total+$dona+intval($pedido->getDeliveryPrice()));
        break;
        case 12:
          $aumento = (($total+$dona+intval($pedido->getDeliveryPrice())+2.9)/(0.96636-(1.16*0.139)))-($total+$dona+intval($pedido->getDeliveryPrice()));
        break;
      }

      $post = [
      "line_items"=> $cArray,
      "shipping_lines"=> [array(
          "amount"=> intval($pedido->getDeliveryPrice()+$aumento),
          "carrier"=> $pedido->getCarrier()
      )],
      "currency"=> "MXN",
      "customer_info"=> array(
          "customer_id"=> $cresult['id'],
      ),
      "shipping_contact"=>array(
           "address"=> array(
               "street1"=> $pedido->getStreet(),
               "postal_code"=> $pedido->getCp(),
               "country"=> "MX"
           )
       ),
       "metadata"=> array("reference"=> $pedido->getId(), "mail" => $alumMail, "photo" => $alumPhoto, "id" => $alumId, "name" => $alumName, "total" =>$total/100 , "totalList"=> $totalList/100, "envio"=> $envio/100),
       "charges"=>[array(
          "payment_method"=> array(
              "monthly_installments" => $month,
              "type"=> "card",
              "payment_source_id"=> $cresult['default_payment_source_id']
          )
        )]
      ];

      $ch=curl_init('https://api.conekta.io/orders');
      $payload = json_encode( $post );
      curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, array('accept: application/vnd.conekta-v2.0.0+json','Content-Type:application/json'));
      curl_setopt( $ch, CURLOPT_USERPWD,$ckey);
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      $decodedText = html_entity_decode(curl_exec($ch));
      $presult = json_decode($decodedText, true);
      curl_close($ch);

      if($presult["object"]=="error"){
        $message = $presult["details"][0]["message"];
        return new JsonResponse(array('error'=>$message));
      }

      $entityManager = $this->getDoctrine()->getManager();
      $pedido = $entityManager->getRepository(Pedido::class)->find($pid);
      $pedido->setPaymentId($presult["charges"]["data"][0]["order_id"]);
      $pedido->setTotal($total+$dona);
      $pedido->setTotalLista($totalList+$dona);
      $pedido->setTipoPago("MESES");

     /* $shippRepo = $entityManager->getRepository(DeliveryRate::class); 
      $shipps = $shippRepo->findBy([
        'pedido_id' => $pid
      ]);
      foreach ($shipps as $sh) {
        $entityManager->remove($sh);
      }
*/
      $entityManager->flush();
  
      return new JsonResponse(array('contenido'=>$content));
    }
    /**
    * @Route("/login", name="login")
    */
    public function login(AuthenticationUtils $utils){
      $error = $utils->getLastAuthenticationError();
      $lastUsername = $utils->getLastUsername();

      return $this->render('admin/login.html.twig', [
          'error' => $error,
          'lastUsername' => $lastUsername
        ]);
    }
    /**
    * @Route("/test")
    */
    public function test(){
      return $this->render('store/phptextingfile.html.twig');
    }
    /**
    * @Route("/logout", name="logout")
    */
    public function logout(){
    }
 		/**
		* @Route("/admin")
		*/
		public function showDashboard(){
			return $this->render('admin/dashboard.html.twig');
		}

    	/**
    	* @Route("/admin/settings", name="settings_view")
    	* @Method("GET")
    	*/
    	public function showSettings(){
    		$uniones = $this->getDoctrine()->getRepository(Conference::class)->findAll();
    		$campos = $this->getDoctrine()->getRepository(Campos::class)->findAll();
    		$Escuelas = $this->getDoctrine()->getRepository(Escuela::class)->findAll();
    		$Temporadas = $this->getDoctrine()->getRepository(Temporadas::class)->findAll();
    		return $this->render('admin/config.html.twig', array('uniones' => $uniones, 'campos' => $campos, 'escuelas' => $Escuelas, 'temporadas'=>$Temporadas));
    	}
     	/**
      	* @Route("/admin/settings/new_conference", name="new_conference")
      	* @Method({"GET", "POST"})
      	*/
     	public function newConference(Request $request) {
     		$conference = new Conference();
     		$form = $this->createFormBuilder($conference)
     		->add('name', TextType::class, array('label' => 'Nombre de la unión', 'attr' => array('class' => 'form-control')))
     		->add('save', SubmitType::class, array(
     			'label' => 'Agregar',
     			'attr' => array('class' => 'btn btn-primary mt-3')
     			))
     		->getForm();

     		$form->handleRequest($request);
     		if($form->isSubmitted() && $form->isValid()) {
     			$conference = $form->getData();
     			$entityManager = $this->getDoctrine()->getManager();
     			$entityManager->persist($conference);
     			$entityManager->flush();
     			return $this->redirectToRoute('settings_view');
     		}
     		return $this->render('admin/addConfig.html.twig', array(
     			'form' => $form->createView()
     			));
     	}
      	/**
      	* @Route("/admin/settings/delete/conference/{id}", name="delete_conference")
      	* @Method({"DELETE"})
      	*/
      	public function deleteConference(Request $request, $id) {
      		$entityManager = $this->getDoctrine()->getManager();
      		$Conference = $this->getDoctrine()->getRepository(Conference::class)->find($id);
      		$camposRepo = $this->getDoctrine()->getRepository(Campos::class);
      		$campos = $camposRepo->findOneBy([
      			'union_id' => $id
      			]);
      		if($campos != null){
      			foreach($campos as $campo) {
      				$entityManager->remove($campo);
      			}
      		}

      		$entityManager->remove($Conference);
      		$entityManager->flush();

      		$uniones = $this->getDoctrine()->getRepository(Conference::class)->findAll();
      		$campos = $this->getDoctrine()->getRepository(Campos::class)->findAll();
      		$Escuelas = $this->getDoctrine()->getRepository(Escuela::class)->findAll();
      		$Temporadas = $this->getDoctrine()->getRepository(Temporadas::class)->findAll();
      		return $this->render('admin/config.html.twig', array('uniones' => $uniones, 'campos' => $campos, 'escuelas' => $Escuelas, 'temporadas'=>$Temporadas));
      	}

      	/**
      	* @Route("/admin/settings/new_campo", name="new_campo")
      	* @Method({"GET", "POST"})
      	*/
      	public function newCampo(Request $request) {
      		$uniones = $this->getDoctrine()->getRepository(Conference::class)->findAll();
      		$conferences = array();
      		if ($uniones != null){
      			foreach ($uniones as $union) {
      				$conferences[$union->getName()] = $union->getId();
      			}
      		}


      		$Campos = new Campos();
      		$form = $this->createFormBuilder($Campos)
      		->add('name', TextType::class, array('label' => 'Nombre del campo', 'attr' => array('class' => 'form-control')))
      		->add('cuenta', TextType::class, array('label' => 'Número de cuenta', 'attr' => array('class' => 'form-control')))
      		->add('union_id', ChoiceType::class, array(
      			'multiple' => false,
      			'choices' => $conferences
      			))
      		->add('save', SubmitType::class, array(
      			'label' => 'Agregar',
      			'attr' => array('class' => 'btn btn-primary mt-3')
      			))
      		->getForm();

      		$form->handleRequest($request);
      		if($form->isSubmitted() && $form->isValid()) {
      			$campo = $form->getData();
      			$entityManager = $this->getDoctrine()->getManager();
      			$entityManager->persist($campo);
      			$entityManager->flush();
      			return $this->redirectToRoute('settings_view');
      		}
      		return $this->render('admin/addConfig.html.twig', array(
      			'form' => $form->createView()
      			));
      	}
      	/**
      	* @Route("/admin/settings/delete/campo/{id}", name="delete_campo")
      	* @Method({"DELETE"})
      	*/
      	public function deleteCampo(Request $request, $id) {
      		$entityManager = $this->getDoctrine()->getManager();
      		$Campo = $this->getDoctrine()->getRepository(Campos::class)->find($id);
      		$entityManager->remove($Campo);
      		$entityManager->flush();

      		$uniones = $this->getDoctrine()->getRepository(Conference::class)->findAll();
      		$campos = $this->getDoctrine()->getRepository(Campos::class)->findAll();
      		$Escuelas = $this->getDoctrine()->getRepository(Escuela::class)->findAll();
      		$Temporadas = $this->getDoctrine()->getRepository(Temporadas::class)->findAll();
      		return $this->render('admin/config.html.twig', array('uniones' => $uniones, 'campos' => $campos, 'escuelas' => $Escuelas, 'temporadas'=>$Temporadas));
      	}

      	/**
      	* @Route("/admin/settings/new_escuela", name="new_escuela")
      	* Method({"GET", "POST"})
      	*/
      	public function newEscuela(Request $request) {

      		$Escuela = new Escuela();
      		$form = $this->createFormBuilder($Escuela)
      		->add('name', TextType::class, array('label' => 'Nombre de la escuela (facultad)', 'attr' => array('class' => 'form-control')))
      		->add('longName', TextType::class, array('label' => 'Nombre completo de la escuela (facultad)', 'attr' => array('class' => 'form-control')))
      		->add('save', SubmitType::class, array(
      			'label' => 'Agregar',
      			'attr' => array('class' => 'btn btn-primary mt-3')
      			))
      		->getForm();

      		$form->handleRequest($request);
      		if($form->isSubmitted() && $form->isValid()) {
      			$escuela = $form->getData();
      			$entityManager = $this->getDoctrine()->getManager();
      			$entityManager->persist($escuela);
      			$entityManager->flush();
      			return $this->redirectToRoute('settings_view');
      		}
      		return $this->render('admin/addConfig.html.twig', array(
      			'form' => $form->createView()
      			));
      	}
      	/**
      	* @Route("/admin/settings/delete/escuela/{id}", name="delete_escuela")
      	* @Method({"DELETE"})
      	*/
      	public function deleteEscuela(Request $request, $id) {
      		$entityManager = $this->getDoctrine()->getManager();
      		$Escuela = $this->getDoctrine()->getRepository(Escuela::class)->find($id);
      		$entityManager->remove($Escuela);
      		$entityManager->flush();

      		$uniones = $this->getDoctrine()->getRepository(Conference::class)->findAll();
      		$campos = $this->getDoctrine()->getRepository(Campos::class)->findAll();
      		$Escuelas = $this->getDoctrine()->getRepository(Escuela::class)->findAll();
      		$Temporadas = $this->getDoctrine()->getRepository(Temporadas::class)->findAll();
      		return $this->render('admin/config.html.twig', array('uniones' => $uniones, 'campos' => $campos, 'escuelas' => $Escuelas, 'temporadas'=>$Temporadas));
      	}

      	/**
      	* @Route("/admin/settings/edit/seasons", name="edit_season")
      	* Method({"POST"})
      	*/
      	public function editSeason(Request $request) {
      		$verano = $this->getDoctrine()->getRepository(Temporadas::class)->find(1);
      		$invierno = $this->getDoctrine()->getRepository(Temporadas::class)->find(2);

      		var_dump($request->request);

      		$entityManager = $this->getDoctrine()->getManager();
      		if($verano == null){
      			$verano = new Temporadas();
      			$verano->setFechaInicial(\DateTime::createFromFormat('Y-m-d', $request->request->get('ver_ini')));
      			$verano->setFechaFinal(\DateTime::createFromFormat('Y-m-d', $request->request->get('ver_fin')));
      			$entityManager->persist($verano);
      		}

      		if($invierno == null){
      			$invierno = new Temporadas();
      			$invierno->setFechaInicial(\DateTime::createFromFormat('Y-m-d', $request->request->get('inv_ini')));
      			$invierno->setFechaFinal(\DateTime::createFromFormat('Y-m-d', $request->request->get('inv_fin')));
      			$entityManager->persist($invierno);
      		}
      		$verano->setFechaInicial(\DateTime::createFromFormat('Y-m-d', $request->request->get('ver_ini')));
      		$verano->setFechaFinal(\DateTime::createFromFormat('Y-m-d', $request->request->get('ver_fin')));

      		$invierno->setFechaInicial(\DateTime::createFromFormat('Y-m-d', $request->request->get('inv_ini')));
      		$invierno->setFechaFinal(\DateTime::createFromFormat('Y-m-d', $request->request->get('inv_fin')));

      		$entityManager->flush();

      		return $this->redirectToRoute('settings_view');
      	}
    
    /**
    * @Route("/admin/ventas", name="ventas_list")
    * @Method("GET")
    */
    public function showVentas(){
      $ventas = $this->getDoctrine()->getRepository(Pedido::class)->getSimpleList();
      return $this->render('admin/ventas.html.twig', array('ventas' => $ventas));
    }
    /**
    * @Route("/admin/ventas/detalle/{id}", name="ventas_detalle")
    * @Method("GET")
    */
    public function showVentasDetalle($id){
      $entityManager = $this->getDoctrine()->getManager();
      $pedido = $entityManager->getRepository(Pedido::class)->find($id);
      $contentRepo = $entityManager->getRepository(PedidoContent::class);
      $content = $contentRepo->findBy([
        'pedido_id' => $id
      ]);
      $cArray = array();
      $subtotal = 0;
      $total = 0;
      foreach ($content as $item) {
        $book = $entityManager->getRepository(Books::class)->find($item->getBookId());
        array_push($cArray, ["foto"=>$book->getPortada(),"name"=>$book->getTitulo(), "price"=>$item->getUnitPrice(), "quantity"=>$item->getQtt(), "total"=>$item->getUnitPrice()*$item->getQtt()]);
        $subtotal += $item->getUnitPrice()*$item->getQtt();
      } 
      $total = $subtotal+$pedido->getDeliveryPrice();
      return $this->render('admin/pedidoDetalle.html.twig', array('pedido'=>$pedido, 'content'=>$cArray, 'subtotal'=>$subtotal, 'total'=>$total));
    }
    /**
    * @Route("/admin/ventas/search/", name="ventas_search")
    * @Method("POST")
    */
    public function searchVentas(Request $request){
      $pedidos = $this->getDoctrine()->getRepository(Pedido::class)->getSimpleList();
      $results = [];
      $text = $request->request->get('text');
      if ($text == '' || $text == null){
        return $this->redirectToRoute('ventas_list');
      }
      $text = strtolower($text);
      foreach ($pedidos as $pedido) {
        if($pedido['id']==$text){
          $results[] = $pedido;
        }else if(strpos($pedido['name'], $text) !== false){
          $results[] = $pedido;
        }else if(strpos($pedido['last'], $text) !== false){
          $results[] = $pedido;
        }else if($pedido['payment_id'] == null && strpos("pagar", $text) !== false){
          $results[] = $pedido;
        }else if($pedido['tracking'] == null && strpos("pendiente", $text) !== false && $pedido['payment_id'] != null){
          $results[] = $pedido;
        }else if($pedido['tracking'] != null && strpos("enviado", $text) !== false && $pedido['payment_id'] != null){
          $results[] = $pedido;
        }
      }
      return $this->render('admin/ventas.html.twig', array('ventas' => $results));
    }
    /**
    * @Route("/admin/ventas/addTracking", name="add_tracking")
    * @Method("POST")
    */
    public function addTracking(Request $request,\Swift_Mailer $mailer){
      $track = $request->request->get('tracking');
      $id = $request->request->get('id');
      $entityManager = $this->getDoctrine()->getManager();
      $pedido = $entityManager->getRepository(Pedido::class)->find($id);
      $pedido->setTracking($track);
      $entityManager->flush();

       $custumerMail = (new \Swift_Message('¡Pedido Emprendum enviado!'))
        ->setFrom('emprendum@emprendum.um.edu.mx')
        ->setTo($pedido->getEmail())
        ->setBody(
            $this->renderView(
                // templates/emails/registration.html.twig
                'mails/trackingMail.html.twig',
                array('tracking' => $track, 'id' => $id)
            ),
            'text/html '
        );
      $mailer->send($custumerMail);
      return $this->redirectToRoute('ventas_list');
    }
    /**
    * @Route("/admin/count/campo", name="campoCount")
    */
    public function showCampoCount(){
      $campos = $this->getDoctrine()->getRepository(Campos::class)->findAll();
      return $this->render('admin/campoCount.html.twig', array('campos' => $campos, 'pedidos' => null));
    }
    /**
    * @Route("admin/count/campo/search", name="campoResult")
    * @Method("POST")
    */
    public function showCampoResult(Request $request){
      $campoId = $request->request->get('campo');
      $campos = $this->getDoctrine()->getRepository(Campos::class)->findAll();
      $campo = $this->getDoctrine()->getRepository(Campos::class)->find($campoId);
      $campoName = $campo->getName();
      $cuenta = $campo->getCuenta();

      $ini = $request->request->get('ini');
      $fin = $request->request->get('fin');

      $pedidos = $this->getDoctrine()->getRepository(Pedido::class)->getByCampo($ini,$fin,$campoId);
      
      $total = 0;
      $totalList = 0;
      $prov = 0;
      for($i=0; $i<sizeof($pedidos); $i++){
        $asoc = $this->getDoctrine()->getRepository(Campos::class)->find($pedidos[$i]['campo_id']);
        $pedidos[$i]['campo_id'] = $asoc->getName(); 
        $total += $pedidos[$i]['total'];
        $prov += $pedidos[$i]['total_lista'];
        $totalList += $pedidos[$i]['total']-$pedidos[$i]['total_lista'];
      }
      $diez = $totalList * 0.1;
      $universitario = $totalList-$diez;

      return $this->render('admin/campoCount.html.twig', array('campo'=>$campoName,'campos' => $campos, 'pedidos' => $pedidos, 'ini' => $ini, 'fin' => $fin, 'cuenta'=> $cuenta, 'diezmos' => $diez, 'estudiante' => $universitario, 'total' => $total, 'proveedor' => $prov));
    }
    /**
    * @Route("/admin/count/universitario", name="universitarioCount")
    */
    public function showUniversitarioCount(){
      $campos = $this->getDoctrine()->getRepository(Campos::class)->findAll();
      return $this->render('admin/universitarioCount.html.twig', array('pedidos' => null));
    }
    /**
    * @Route("admin/count/universitario/search", name="universitarioResult")
    * @Method("POST")
    */
    public function showUniversitarioResult(Request $request){
      $matricula = $request->request->get('matricula');
      $student = $this->getDoctrine()->getRepository(Students::class)->findOneBy(['matricula' => $matricula]);
      $ver = $this->getDoctrine()->getRepository(Campos::class)->find($student->getVerano());
      $verano = $ver->getName();
      $inv = $this->getDoctrine()->getRepository(Campos::class)->find($student->getInvierno());
      $invierno = $inv->getName();
      $inter = $this->getDoctrine()->getRepository(Campos::class)->find($student->getInter());
      $intersemestral = $inter->getName();

      $ini = $request->request->get('ini');
      $fin = $request->request->get('fin');

      $pedidos = $this->getDoctrine()->getRepository(Pedido::class)->getByEstudiante($ini,$fin,$student->getId());
      
      $total = 0;
      $totalList = 0;
      $prov = 0;
      for($i=0; $i<sizeof($pedidos); $i++){
        $asoc = $this->getDoctrine()->getRepository(Campos::class)->find($pedidos[$i]['campo_id']);
        $pedidos[$i]['campo_id'] = $asoc->getName(); 
        $total += $pedidos[$i]['total'];
        $prov += $pedidos[$i]['total_lista'];
        $totalList += $pedidos[$i]['total']-$pedidos[$i]['total_lista'];
      }
      $diez = $totalList * 0.1;
      $universitario = $totalList-$diez;

      return $this->render('admin/universitarioCount.html.twig', array('invierno'=>$invierno, 'verano'=>$verano, 'inter'=>$intersemestral, 'matricula'=>$matricula, 'nombre'=> $student->getName().' '.$student->getApellidos(), 'pedidos' => $pedidos, 'ini' => $ini, 'fin' => $fin, 'diezmos' => $diez, 'estudiante' => $universitario, 'total' => $total, 'proveedor' => $prov));
    }
		/**
		* @Route("/admin/books", name="books_list")
		* @Method("GET")
		*/
		public function showBooks(){
			$books = $this->getDoctrine()->getRepository(Books::class)->findAll();
			return $this->render('admin/books.html.twig', array('books' => $books));
		}
    /**
    * @Route("/admin/books/delete/{id}", name="delete_book")
    * @Method({"DELETE"})
    */
    public function deleteBook(Request $request, $id) {
      $book = $this->getDoctrine()->getRepository(Books::class)->find($id);
      if ($book->getImagenes() != null){
        foreach($book->getImagenes() as $imagen){
          $file = $imagen;
          $filename = "uploads/books_imgs/".$file;
          unlink($filename);
        }
      }

      if ($book->getPortada() != null){
        $portada = $book->getPortada();
        unlink("uploads/books_imgs/".$portada);
      }
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($book);
      $entityManager->flush();
        
      $books = $this->getDoctrine()->getRepository(Books::class)->findAll();
      return $this->render('admin/books.html.twig', array('books' => $books));
    }
		/**
		* @Route("/admin/books/search/", name="books_search")
		* @Method("POST")
		*/
		public function searchBooks(Request $request){
			$books = $this->getDoctrine()->getRepository(Books::class)->findAll();
			$results = [];
			$text = $request->request->get('text');
			if ($text == '' || $text == null){
				return $this->render('admin/books.html.twig', array('books' => $books));
			}
			foreach ($books as $book) {
				if($book->getId()==$text){
					$results[] = $book;
				}else if(strpos($book->getTitulo(), $text) !== false){
					$results[] = $book;
				}else if(strpos($book->getAutor(), $text) !== false){
					$results[] = $book;
				}else{
					foreach ($book->getCategorias() as $cat) {
						if(strpos($cat, $text) !== false){
							$results[] = $book;
							break;
						}
					}
				}
			}
			return $this->render('admin/books.html.twig', array('books' => $results));
		}
    
		  /**
     	* @Route("/admin/books/newBook", name="new_book")
     	* @Method({"GET", "POST"})
     	*/
     	public function newBook(Request $request) {
     		$book = new Books();
     		$form = $this->createFormBuilder($book)
     		->add('titulo', TextType::class, array('attr' => array('class' => 'form-control')))
     		->add('autor', TextType::class, array('attr' => array('class' => 'form-control')))
     		->add('editorial', TextType::class, array('attr' => array('class' => 'form-control')))
     		->add('disponibles', NumberType::class, array('attr' => array('class' => 'form-control')))
     		->add('year', NumberType::class, array('label' => 'Año','attr' => array('class' => 'form-control')))
     		->add('colportor', NumberType::class, array('attr' => array('class' => 'form-control')))
     		->add('publico', NumberType::class, array('attr' => array('class' => 'form-control')))
     		->add('peso', NumberType::class, array('label'=>'Peso (kg)','attr' => array('class' => 'form-control')))
     		->add('width', NumberType::class, array('label' => 'Ancho (cm)','attr' => array('class' => 'form-control')))
        ->add('height', NumberType::class, array('label' => 'Alto (cm)','attr' => array('class' => 'form-control')))
        ->add('length', NumberType::class, array('label' => 'Grosor (cm)','attr' => array('class' => 'form-control')))
     		->add('descripcion', TextareaType::class, array(
     			'required' => true,
     			'label' => 'Descripción',
     			'attr' => array('class' => 'form-control')
     			))
     		->add('categorias', ChoiceType::class, array(
     			'multiple' => true,
     			'choices' => array(
     				'Bienestar físico'=>'0',
     				'Equilibrio emocional'=>'1',
     				'Evaluación de vida'=>'2'
     				),
     			))
     		->add('portada', FileType::class, array(
     			'label' => 'Portada'
     			))
     		->add('imagenes', FileType::class, array(
     			'label' => 'Fotos',
     			'multiple' => true
     			))
     		->add('save', SubmitType::class, array(
     			'label' => 'Create',
     			'attr' => array('class' => 'btn btn-primary mt-3')
     			))
     		->getForm();

     		$form->handleRequest($request);
     		if($form->isSubmitted() && $form->isValid()) {
     			$book = $form->getData();

     			$imagenes = $book->getImagenes();
     			$filenames = [];
     			if ($imagenes){
     				foreach($imagenes as $imagen){
     					$file = $imagen;

     					var_dump($imagen);
     					$filename = md5(uniqid()). '.' .$file->guessExtension();

     					$file->move($this->getParameter('books_imgs'), $filename);
     					var_dump($filename);
     					$filenames[] = $filename;
     				}
     			}
     			$book->setImagenes($filenames);

     			$file = $book->getPortada();
     			var_dump($file);
     			$filename = md5(uniqid()). '.' .$file->guessExtension();
     			$file->move($this->getParameter('books_imgs'),$filename);
     			$book->setPortada($filename);

     			$entityManager = $this->getDoctrine()->getManager();
     			$entityManager->persist($book);
     			$entityManager->flush();
     			return $this->redirectToRoute('books_list');
     		}
     		return $this->render('admin/newBook.html.twig', array(
     			'form' => $form->createView()
     			));
     	}

    	/**
     	* @Route("/admin/books/editBook/{id}", name="edit_book")
     	* @Method({"GET", "POST"})
     	*/
     	public function editBook(Request $request, $id) {
     		$book = new Books();
     		$book = $this->getDoctrine()->getRepository(Books::class)->find($id);
     		$form = $this->createFormBuilder($book)
     		->add('titulo', TextType::class, array('attr' => array('class' => 'form-control')))
     		->add('autor', TextType::class, array('attr' => array('class' => 'form-control')))
     		->add('editorial', TextType::class, array('attr' => array('class' => 'form-control')))
     		->add('disponibles', NumberType::class, array('attr' => array('class' => 'form-control')))
     		->add('year', NumberType::class, array('label' => 'Año','attr' => array('class' => 'form-control')))
     		->add('colportor', NumberType::class, array('attr' => array('class' => 'form-control')))
     		->add('publico', NumberType::class, array('attr' => array('class' => 'form-control')))
     		->add('peso', NumberType::class, array('label'=>'Peso (kg)','attr' => array('class' => 'form-control')))
     		->add('width', NumberType::class, array('label' => 'Ancho (cm)','attr' => array('class' => 'form-control')))
        ->add('height', NumberType::class, array('label' => 'Alto (cm)','attr' => array('class' => 'form-control')))
     		->add('descripcion', TextareaType::class, array(
     			'required' => true,
     			'label' => 'Descripción',
     			'attr' => array('class' => 'form-control')
     			))
     		->add('categorias', ChoiceType::class, array(
     			'multiple' => true,
     			'choices' => array(
            'Bienestar físico'=>'0',
            'Equilibrio emocional'=>'1',
            'Evaluación de vida'=>'2'
     				),
     			))
     		->add('portada', FileType::class, array(
     			'label' => 'Portada',
          'data_class' => null
     			))
     		->add('imagenes', FileType::class, array(
     			'label' => 'Fotos',
     			'multiple' => true,
          'data_class' => null
     			))
     		->add('save', SubmitType::class, array(
     			'label' => 'Create',
     			'attr' => array('class' => 'btn btn-primary mt-3')
     			))
     		->getForm();

     		$form->handleRequest($request);
     		if($form->isSubmitted() && $form->isValid()) {
$book = $form->getData();
$imagenes = $book->getImagenes();
     			$filenames = [];
     			if ($imagenes){
     				foreach($imagenes as $imagen){
     					$file = $imagen;

     					var_dump($imagen);
     					$filename = md5(uniqid()). '.' .$file->guessExtension();

     					$file->move($this->getParameter('books_imgs'), $filename);
     					var_dump($filename);
     					$filenames[] = $filename;
     				}
}
$book->setImagenes($filenames);

     			$file = $book->getPortada();
     			var_dump($file);
     			$filename = md5(uniqid()). '.' .$file->guessExtension();
     			$file->move($this->getParameter('books_imgs'),$filename);
     			$book->setPortada($filename);

$entityManager = $this->getDoctrine()->getManager();
$entityManager->persist($book);
     			$entityManager->flush();
     			return $this->redirectToRoute('books_list');
     		}
     		return $this->render('admin/editBook.html.twig', array(
     			'form' => $form->createView(),
     			'book' => $book
     			));
     	}

      	/**
      	* @Route("/admin/students", name="students_list")
      	* @Method("GET")
      	*/
      	public function showStudents(){
      		$students = $this->getDoctrine()->getRepository(Students::class)->findAll();
      		return $this->render('admin/students.html.twig', array('students' => $students));
      	}
      	/**
      	* @Route("/admin/students/search/", name="students_search")
      	* @Method("POST")
      	*/
     	public function searchStudents(Request $request){
      		$students = $this->getDoctrine()->getRepository(Students::class)->findAll();
      		$results = [];
      		$text = $request->request->get('text');
      		if ($text == '' || $text == null){
      			return $this->render('admin/students.html.twig', array('students' => $students));
      		}
      		foreach ($students as $student) {
      			if($student->getId()==$text){
      				$results[] = $student;
      			}else if(strpos($student->getName(), $text) !== false){
      				$results[] = $student;
      			}else if(strpos($student->getApellidos(), $text) !== false){
      				$results[] = $student;
      			}else if(strpos($student->getTelefono(), $text) !== false){
      				$results[] = $student;
      			}else if(strpos($student->getCorreo(), $text) !== false){
      				$results[] = $student;
      			}else if(strpos($student->getFacultad(), $text) !== false){
      				$results[] = $student;
      			}
      		}
      		return $this->render('admin/students.html.twig', array('students' => $results));
      	}
      	/**
      	* @Route("/admin/students/newStudent", name="new_student")
      	* @Method({"GET", "POST"})
      	*/
      	public function newStudent(Request $request) {
      		$student = new Students();

      		$escuelas = $this->getDoctrine()->getRepository(Escuela::class)->findAll();
      		$facs = array();
      		if ($escuelas != null){
      			foreach ($escuelas as $e) {
      				$facs[$e->getLongName()] = $e->getId();
      			}
      		}
      		$campos = $this->getDoctrine()->getRepository(Campos::class)->findAll();
      		$asocs = array();
      		if ($campos != null){
      			foreach ($campos as $c) {
      				$asocs[$c->getName()] = $c->getId();
      			}
      		}
      		$form = $this->createFormBuilder($student)
      		->add('name', TextType::class, array('label'=>'Nombre','attr' => array('class' => 'form-control')))
      		->add('apellidos', TextType::class, array('attr' => array('class' => 'form-control')))
      		->add('matricula', TextType::class, array('attr' => array('class' => 'form-control')))
      		->add('telefono', TextType::class, array('attr' => array('class' => 'form-control')))
      		->add('correo', TextType::class, array('attr' => array('class' => 'form-control')))
      		->add('link', TextType::class, array('attr' => array('class' => 'form-control')))
      		->add('facultad', ChoiceType::class, array('choices' => $facs))
      		->add('verano', ChoiceType::class, array('choices' => $asocs))
      		->add('invierno', ChoiceType::class, array('choices' => $asocs))
      		->add('inter', ChoiceType::class, array('choices' => $asocs))
      		->add('status', ChoiceType::class, array(
      			'choices' => array(
      				'verde'=>'0',
      				'amarillo'=>'1',
      				'rojo'=>'2'
      				),
      			))
      		->add('tipo', ChoiceType::class, array(
      			'choices' => array(
      				'inactivo'=>'0',
      				'activo'=>'1'
      				),
      			))
      		->add('descripcion', TextareaType::class, array(
      			'required' => true,
      			'label' => 'Descripción',
      			'attr' => array('class' => 'form-control')
      			))
      		->add('foto', FileType::class, array(
      			'label' => 'Foto',
      			'multiple' => false
      			))
      		->add('save', SubmitType::class, array(
      			'label' => 'Create',
      			'attr' => array('class' => 'btn btn-primary mt-3')
      			))
      		->getForm();

      		$form->handleRequest($request);
      		if($form->isSubmitted() && $form->isValid()) {
      			$student = $form->getData();
      			$student->setInvU(0);
      			$student->setIntU(0);
      			$student->setVerU(0);
      			$file = $form->get('foto')->getData();
      			var_dump($file);
      			$filename = md5(uniqid()). '.' .$file->guessExtension();
      			$file->move($this->getParameter('students_imgs'),$filename);
      			$student->setFoto($filename);

      			$entityManager = $this->getDoctrine()->getManager();
      			$entityManager->persist($student);
      			$entityManager->flush();
      			return $this->redirectToRoute('students_list');
      		}
      		return $this->render('admin/newStudent.html.twig', array(
      			'form' => $form->createView()
      			));
     	}
      /**
      * @Route("/admin/students/delete/{id}", name="delete_student")
      * @Method({"DELETE"})
      */
      public function deleteStudent(Request $request, $id) {
      	$student = $this->getDoctrine()->getRepository(Students::class)->find($id);

      	if ($student->getFoto() != null){
      		$foto = $student->getFoto();
      		unlink("uploads/students_imgs/".$foto);
      	}
      	$entityManager = $this->getDoctrine()->getManager();
      	$entityManager->remove($student);
      	$entityManager->flush();
        $students = $this->getDoctrine()->getRepository(Students::class)->findAll();
      	return $this->render('admin/students.html.twig', array('students' => $students));
      }

      /**
      * @Route("/admin/contenido", name="contenido_view")
      * @Method("GET")
      */
      public function showContenido(){
      	$promos = $this->getDoctrine()->getRepository(Promo::class)->findAll();
      	$students = $this->getDoctrine()->getRepository(IndxStudent::class)->findAll();
      	$youtube = $this->getDoctrine()->getRepository(ExtraConfig::class)->findAll();
      	return $this->render('admin/market.html.twig', array('promos' => $promos, "students" => $students, "youtube" => $youtube));
     	}
      /**
      * @Route("/admin/contenido/promo/", name="promo_upload")
     	* @Method("POST")
     	*/
     	public function addPromo(Request $request){
      		var_dump($request->request);
      		$file = $request->files->get('foto');
      		var_dump($file);
      		$filename = md5(uniqid()). '.' .$file->guessExtension();
      		$file->move($this->getParameter('promo_imgs'),$filename);


      		$promo = new Promo();
      		$promo->setFoto($filename);
      		$promo->setName($filename);

      		$entityManager = $this->getDoctrine()->getManager();
      		$entityManager->persist($promo);
      		$entityManager->flush();

      		return $this->redirectToRoute('contenido_view');
      	}
      	/**
      	* @Route("/admin/contenido/promo/delete/{id}", name="delete_promo")
      	* @Method({"DELETE"})
      	*/
      	public function deletePromo(Request $request, $id) {
      		$promo = $this->getDoctrine()->getRepository(Promo::class)->find($id);

      		if ($promo->getFoto() != null){
      			$foto = $promo->getFoto();
      			unlink("uploads/promo_imgs/".$foto);
      		}
      		$entityManager = $this->getDoctrine()->getManager();
      		$entityManager->remove($promo);
      		$entityManager->flush();

      		return $this->redirectToRoute('contenido_view');
      	}
      	/**
      	* @Route("/admin/contenido/student/", name="indx_student_upload")
      	* @Method("POST")
      	*/
      	public function addIndxStudent(Request $request){
      		var_dump($request->request);
      		$file = $request->files->get('foto');
      		var_dump($file);
      		$filename = md5(uniqid()). '.' .$file->guessExtension();
      		$file->move($this->getParameter('promo_imgs'),$filename);


      		$student = new IndxStudent();
      		$student->setFoto($filename);

      		$entityManager = $this->getDoctrine()->getManager();
      		$entityManager->persist($student);
      		$entityManager->flush();

      		return $this->redirectToRoute('contenido_view');
      	}
      	/**
      	* @Route("/admin/contenido/student/delete/{id}", name="delete_Indx_student")
      	* @Method({"DELETE"})
     	*/
      	public function deleteIndxStudent(Request $request, $id) {
      		$student = $this->getDoctrine()->getRepository(IndxStudent::class)->find($id);

      		if ($student->getFoto() != null){
      			$foto = $student->getFoto();
      			unlink("uploads/promo_imgs/".$foto);
      		}
      		$entityManager = $this->getDoctrine()->getManager();
      		$entityManager->remove($student);
      		$entityManager->flush();

      		return $this->redirectToRoute('contenido_view');
      	}
      	/**
      	* @Route("/admin/contenido/edit/youtube", name="edit_youtube")
      	* @Method({"POST"})
      	*/
      	public function editYoutube(Request $request) {
      		$link = $this->getDoctrine()->getRepository(ExtraConfig::class)->find(1);
      		$channel = $this->getDoctrine()->getRepository(ExtraConfig::class)->find(2);

      		$entityManager = $this->getDoctrine()->getManager();
      		if($link == null){
      			$link = new ExtraConfig();
      			$link->setValor($request->request->get('index_video'));
      			$entityManager->persist($link);
      		}

      		if($channel == null){
      			$channel = new ExtraConfig();
      			$channel->setValor($request->request->get('channel_id'));
      			$entityManager->persist($channel);
      		}

      		$link->setValor($request->request->get('index_video'));
      		$channel->setValor($request->request->get('channel_id'));
      		$entityManager->flush();

      		return $this->redirectToRoute('contenido_view');
      	}
        /**
        * @Route("/admin/contenido/edit/showEditor/{key}", name="editor")
        * @Method({"GET"})
        */
        public function showEditor($key) {
          $title='';
          if($key=='faqs'){
            $title = "Preguntas frecuentes";
          }else if($key=='priv'){
            $title = "Politicas de privacidad";
          }else if($key=='terms'){
            $title = "Términos y condiciones";
          }else{
            return $this->redirectToRoute('contenido_view');
          }
          $repository = $this->getDoctrine()->getRepository(Legal::class);
          $text = $repository->findOneBy(['name' => $key]);

          return $this->render('admin/textEditor.html.twig', array('id' => $key, 'text' => $text, 'title' => $title));
        }
        /**
        * @Route("/admin/contenido/edit/long_text/{key}", name="saveEditor")
        * @Method({"GET","POST"})
        */
        public function saveEditor(Request $request, $key) {
          $text = $this->getDoctrine()->getRepository(Legal::class)->findOneBy([
            'name' => $key
            ]);

          $entityManager = $this->getDoctrine()->getManager();
          if($text == null){
            $text = new Legal();
            $text->setContent($request->request->get('text'));
            $text->setName($key);
            $entityManager->persist($text);
          }

          $text->setContent($request->request->get('text'));
          $text->setName($key);

          $entityManager->flush();

          return $this->redirectToRoute('contenido_view');
        }
  }
