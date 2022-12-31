// To parse this JSON data, do
//
//     final users = usersFromJson(jsonString);

import 'dart:convert';

UserModel usersFromJson(String str) => UserModel.fromJson(json.decode(str));

String usersToJson(UserModel data) => json.encode(data.toJson());

class UserModel {
  String? name;
  String? fullname;
  String? email;
  String? access;
  String? updatedAt;
  String? createdAt;
  int? id;
  String? token;
  UserModel({
    this.name,
    this.fullname,
    this.email,
    this.access,
    this.updatedAt,
    this.createdAt,
    this.id,
    this.token,
  });

  factory UserModel.fromJson(Map<String, dynamic> json) => UserModel(
        name: json["name"],
        fullname: json["fullname"],
        email: json["email"],
        access: json["access"],
        updatedAt: (json["updated_at"]),
        createdAt: (json["created_at"]),
        id: json["id"],
        token: json["token"],
      );

  Map<String, dynamic> toJson() => {
        "name": name,
        "fullname": fullname,
        "email": email,
        "access": access,
        "updated_at": updatedAt,
        "created_at": createdAt,
        "id": id,
        "token": token,
      };
}
