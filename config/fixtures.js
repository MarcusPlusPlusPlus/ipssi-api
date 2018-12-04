const Location = require("../models/location")
const Barrack = require("../models/barrack")
const Item = require("../models/item")
const Group = require("../models/group")
const Person = require("../models/person")
class Fixtures {
    constructor() {
        const location = new Location()
        location.name = "Neptune"
        location.save()

        const interventionLocation = new Location()
        interventionLocation.name = "Manifestation #1"
        interventionLocation.save()

        const barrack = new Barrack()
        barrack.name = "Caserne principale"
        barrack.locationId = location._id
        barrack.save()

        const item = new Item()
        item.name = "Bouclier"
        item.cost = item.stock = 1
        item.save()

        const group = new Group()
        const person = new Person()
        group.name = "1A"
        group.listfPersons = [person._id]
        group.barrackId = barrack._id
        person.groupId = group._id
        group.save()
        person.save()
    }
}

module.exports = Fixtures