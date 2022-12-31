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
        fullname: json["username"],
        access: json["access"],
        token: json["token"],
        email: json["user"]["email"],
        name: json["user"]["name"],
        updatedAt: (json["user"]["updated_at"]),
        createdAt: (json["user"]["created_at"]),
        id: json["user"]["id"],
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
