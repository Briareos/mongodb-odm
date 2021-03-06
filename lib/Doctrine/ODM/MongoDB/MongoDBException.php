<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\ODM\MongoDB;

/**
 * Class for all exceptions related to the Doctrine MongoDB ODM
 *
 * @since       1.0
 * @author      Jonathan H. Wage <jonwage@gmail.com>
 */
class MongoDBException extends \Exception
{
    public static function invalidFindByCall($documentName, $fieldName, $method)
    {
        return new self(sprintf('Invalid find by call %s::$fieldName (%s)', $documentName, $fieldName, $method));
    }

    public static function detachedDocumentCannotBeRemoved()
    {
        return new self('Detached document cannot be removed');
    }

    public static function invalidDocumentState($state)
    {
        return new self(sprintf('Invalid document state "%s"', $state));
    }

    public static function documentNotMappedToCollection($className)
    {
        return new self(sprintf('The "%s" document is not mapped to a MongoDB database collection.', $className));
    }

    public static function documentManagerClosed()
    {
        return new self('The DocumentManager is closed.');
    }

    public static function findByRequiresParameter($methodName)
    {
        return new self("You need to pass a parameter to '".$methodName."'");
    }

    public static function unknownDocumentNamespace($documentNamespaceAlias)
    {
        return new self("Unknown Document namespace alias '$documentNamespaceAlias'.");
    }

    public static function cannotPersistMappedSuperclass($className)
    {
        return new self('Cannot persist an embedded document or mapped superclass ' . $className);
    }

    public static function queryNotIndexed($className, $unindexedFields)
    {
        return new self(sprintf('Cannot execute unindexed queries on %s. Unindexed fields: %s',
            $className,
            implode(', ', $unindexedFields)
        ));
    }

    public static function shardKeyFieldCannotBeChanged($field, $className, $changeSet)
    {
        return new self(sprintf('Shard key field "%s" cannot be changed. Class: %s, Data Change Set: %s', $field, $className, json_encode($changeSet)));
    }

    public static function shardKeyFieldMissing($field, $className)
    {
        return new self(sprintf('Shard key field "%s" is missing. Class: %s.', $field, $className));
    }

    public static function failedToEnableSharding($dbName, $errorMessage)
    {
        return new self(sprintf('Failed to enable sharding for database "%s". Error from MongoDB: %s',
            $dbName,
            $errorMessage
        ));
    }

    public static function failedToEnsureDocumentSharding($className, $errorMessage)
    {
        return new self(sprintf('Failed to ensure sharding for document "%s". Error from MongoDB: %s',
            $className,
            $errorMessage
        ));
    }
}
