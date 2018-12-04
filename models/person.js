const mongoose = require("mongoose")

let PersonSchema = mongoose.Schema({
    name: {type: String, require: true, default: "Jean Dupont"},
    rank: {type: String, require: true, default: "DefaultRank"},
    registrationNumber: {type: Number, require: true, default: 1186},
    groupId: {type: mongoose.Schema.Types.ObjectId, require: true, ref: "Group"},
    dream: String

})
module.exports = mongoose.model("Person", PersonSchema)
