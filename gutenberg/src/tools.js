
export function getClassNameFromProperty(object, key, needSpaceBeforeClassName = true) {
    let prefix = (needSpaceBeforeClassName) ? " " : "";
    return (object[key] !== undefined) ? prefix + object[key] : "";
}
