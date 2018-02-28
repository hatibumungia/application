<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * get all students
 */
$app->get('/endpoints/all_students',function(Request $request, Response $response){
    try{
        //create database object
        $db = new DB();

        //make db connection
        $conn= $db->connect();

        $SQL="SELECT * FROM tbl_student";
        $STMT=$conn->prepare($SQL);
        $STMT->execute();
        if ($STMT->rowCount() > 0){
            $Data=$STMT->fetchAll(PDO::FETCH_OBJ);
            $result = array("code"=>200,"status"=>"Success","data"=>$Data);
        }else{
            $result = array("code"=>404,"status"=>"Not Found");
        }

        return $response->withJson($result);

    }catch (PDOException $e){
        $exception= array("code"=>500,"status"=>"PDOException Error:".$e->getMessage());

        return $response->withJson($exception);
    }

    //close connection
    $conn = null;
});

//create student
$app->post('/endpoints/create_student',function(Request $request, Response $response){
    $data=json_decode($request->getBody());
    try{
        //create database object
        $db = new DB();

        //make db connection
        $conn= $db->connect();

        $SQL="INSERT INTO tbl_student(fname, mname, lname, gender)VALUES(:fname,:mname,:lname,:gender)";
        $stmt=$conn->prepare($SQL);
        $stmt->bindParam(":fname",$data->fname);
        $stmt->bindParam(":mname",$data->mname);
        $stmt->bindParam(":lname",$data->lname);
        $stmt->bindParam(":gender",$data->gender);
        if($stmt->execute()){
            $result = array("code"=>200,"status"=>"Successfully Created");
        }else{
            $result = array("code"=>400,"status"=>"Failed to Create");
        }
        return $response->withJson($result);

    }catch (PDOException $e){
        $exception= array("code"=>500,"status"=>"PDOException Error:".$e->getMessage());
        return $response->withJson($exception);
    }

    //close connection
    $conn = null;
});

/**
 * Delete staff
 */
$app->delete('/endpoints/delete_student/{student_id}',function(Request $request, Response $response){
    $student_id=$request->getAttribute('student_id');
    try{
        //create database object
        $db = new DB();

        //make db connection
        $conn= $db->connect();

        $SQL="DELETE FROM tbl_student WHERE id={$student_id}";
        $STMT=$conn->prepare($SQL);
        if($STMT->execute()){
            $result = array("code"=>200,"status"=>"Successfully Delete");
        }else{
            $result = array("code"=>400,"status"=>"Failed to Delete Staff");
        }

        return $response->withJson($result);

    }catch (PDOException $e){
        $exception= array("code"=>500,"status"=>"PDOException Error:".$e->getMessage());
        return $response->withJson($exception);
    }

    //close connection
    $conn = null;
});
