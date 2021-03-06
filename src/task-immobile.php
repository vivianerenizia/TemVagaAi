<?php
	
	class taskImmobile {
	 	
		private $connect;
		private $immobile;

		public function __construct(Conection $connect, Immobile $immobile){
			$this->connect = $connect->connect();
			$this->immobile = $immobile;
		}	
	
		public function insert() {
			$query = 'insert into immobile (title,image1,image2,state,city,rooms,value_daily,phone,description)
			values (:title, :image1, :image2, :state, :city, :rooms, :value_daily, :phone, :description)';
			$stmt = $this->connect->prepare($query);
			$stmt->bindValue(':title', $this->immobile->__get('title'));
			$stmt->bindValue(':image1', $this->immobile->__get('image1'));
			$stmt->bindValue(':image2', $this->immobile->__get('image2'));
			$stmt->bindValue(':state', $this->immobile->__get('state'));
			$stmt->bindValue(':city', $this->immobile->__get('city'));
			$stmt->bindValue(':rooms', $this->immobile->__get('rooms'));
			$stmt->bindValue(':value_daily', $this->immobile->__get('value_daily'));
            $stmt->bindValue(':phone', $this->immobile->__get('phone'));
            $stmt->bindValue(':description', $this->immobile->__get('description'));

			if($stmt->execute()) {
				echo "Sucesso ao inserir";
				return $this->connect->lastInsertId();
			} else {
				echo "Erro ao inserir";
			}
		}
		
		public function update() {
			$query = 'update immobile set title = :title, image1 = :image1, image2 = :image2, state = :state, city = :city, rooms = :rooms, value_daily = :value_daily, phone = :phone, description = :description where id = :id';
			$stmt = $this->connect->prepare($query);
			$stmt->bindValue(':id', $this->immobile->__get('id'));
			$stmt->bindValue(':title', $this->immobile->__get('title'));
			$stmt->bindValue(':image1', $this->immobile->__get('image1'));
			$stmt->bindValue(':image2', $this->immobile->__get('image2'));
			$stmt->bindValue(':state', $this->immobile->__get('state'));
			$stmt->bindValue(':city', $this->immobile->__get('city'));
			$stmt->bindValue(':rooms', $this->immobile->__get('rooms'));
			$stmt->bindValue(':value_daily', $this->immobile->__get('value_daily'));
            $stmt->bindValue(':phone', $this->immobile->__get('phone'));
			$stmt->bindValue(':description', $this->immobile->__get('description'));
				
			if($stmt->execute()) {
				echo "Sucesso ao atualizar ";
			}else{
				echo "Erro ao atualizar";
			}
		}

		public function read() {
			$query = 'select * from immobile ORDER BY id DESC';
			$stmt = $this->connect->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function readId($idUrl) {
			$query = "select * from immobile where id = '$idUrl' ORDER BY id DESC";
			$stmt = $this->connect->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function delete($idUrl) {
			$query = 'delete from immobile where id ='.$idUrl;
			$stmt = $this->connect->prepare($query);
			if($stmt->execute()){
				echo "Sucesso ao deletar";
			}else{
				echo "Erro ao deletar";
			}
		}

		public function search($city, $min, $max) {
			$query = "select * from immobile where city = '$city' AND value_daily >= '$min' AND value_daily <= '$max'";
			$stmt = $this->connect->prepare($query);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
	}
?>