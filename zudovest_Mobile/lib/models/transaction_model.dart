class TransactionModel {
    TransactionModel({
        required this.id,
        required this.customerId,
        required this.agentId,
        required this.trxType,
        required this.amount,
        required this.purpose,
        required this.sync,
        this.deletedAt,
        required this.createdAt,
        required this.updatedAt,
        required this.approved,
        this.withdrawType,
        this.initiatedBy,
    });

    int id;
    String customerId;
    String agentId;
    String trxType;
    String amount;
    String purpose;
    String sync;
    dynamic deletedAt;
    DateTime createdAt;
    DateTime updatedAt;
    String approved;
    dynamic withdrawType;
    dynamic initiatedBy;

    factory TransactionModel.fromJson(Map<String, dynamic> json) => TransactionModel(
        id: json["id"],
        customerId: json["customer_id"],
        agentId: json["agent_id"],
        trxType: json["trx_type"],
        amount: json["amount"],
        purpose: json["purpose"],
        sync: json["sync"],
        deletedAt: json["deleted_at"],
        createdAt: DateTime.parse(json["created_at"]),
        updatedAt: DateTime.parse(json["updated_at"]),
        approved: json["approved"],
        withdrawType: json["withdraw_type"],
        initiatedBy: json["initiated_by"],
    );

    Map<String, dynamic> toJson() => {
        "id": id,
        "customer_id": customerId,
        "agent_id": agentId,
        "trx_type": trxType,
        "amount": amount,
        "purpose": purpose,
        "sync": sync,
        "deleted_at": deletedAt,
        "created_at": createdAt.toIso8601String(),
        "updated_at": updatedAt.toIso8601String(),
        "approved": approved,
        "withdraw_type": withdrawType,
        "initiated_by": initiatedBy,
    };
}
